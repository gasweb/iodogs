<?php
namespace IodogsApplication\Navigation;
 
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;
 
class MenuNavigation extends DefaultNavigationFactory
{
    private static function hasChildren(Array &$nodes, $parentId)
    {
        foreach ($nodes AS $node)
            {
                if(isset($node->parentId) && $node->parentId == $parentId)
                    return true;
            }       
        return false;
    }

    private static function getChildren (Array &$nodes, $parentId)
    {
        $tempArray = array();
        foreach($nodes AS $node)
        {           
            if(isset($node->parentId) && $node->parentId == $parentId)
            {
                if(self::hasChildren($nodes, $node->parentId))
                    $node->pages = self::getChildren($nodes, $node->id);
            $tempArray[] = get_object_vars($node);
            }
        }

        return $tempArray;
    }
    
    protected function getCatalog(ServiceLocatorInterface $serviceLocator)
    {
        /*
        Собираем массив каталога для меню и хлебных крошек
        @catalog - массив который будем возвращать
        @categoryMenuItem - массив одного элемента меню который будем возвращать
        @categories - массив объектов категорий (шампуни, кондиционеры, то что показываем в меню)
        @lines - массив объектов линий продуктов (кутюр, салонная)
        Показываем только тех у кого есть линия, кто есть в каталоге и активен на сайте
        */
        $catalog = array();
        $categoryMenuItem = array();
        $objectManager = $serviceLocator
                ->get('Doctrine\ORM\EntityManager');            
        $categories = $objectManager->
        getRepository('IodogsDoctrine\Entity\Category')->
        findAll();
        $lines = $objectManager->
        getRepository('IodogsDoctrine\Entity\Line')->
        findAll();

        if(is_array($categories))
        {
            foreach ($categories as $category) {
                $categoryMenuItem = array(
                                    "label" => $category->getTitle(),
                                    'params' => array('slug' => $category->getSlug()),
                                    'route' => 'category-slug',
                                         );
                foreach($lines AS $line)
                {
                    $categoryMenuItem['pages'][$line->getId()] = array(
                                    "label" => $line->getTitle(),
                                    'params' => array('slug' => $line->getSlug()),
                                    'route' => 'line/line-id',
                                         );

                $categoryProducts = $objectManager->
                getRepository('IodogsDoctrine\Entity\Product')->
                findBy(array(
                    "category" => $category->getId(),
                    "line" => $line->getId(), 
                    "active" => 1));
                if(is_array($categoryProducts))
                {
                    foreach($categoryProducts AS $product)
                    {
                        $categoryMenuItem['pages'][$line->getId()]['pages'][] = array(                                                                                                           
                                    "label" => $product->getEngTitle(),
                                    'params' => array('slug' => $product->getSlug()),
                                    'route' => 'product',                       
                                         );                        
                    }
                }            
                }
            $catalog[] = $categoryMenuItem;
            unset($categoryMenuItem);
            }
         return $catalog;
        }

    }

    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        if (null === $this->pages){
            $objectManager = $serviceLocator
                ->get('Doctrine\ORM\EntityManager');            
        $Iodogs = $objectManager->
        getRepository('IodogsDoctrine\Entity\Content')->
        findBy(array("active" => 1, "menuShow" => 1), array("menuOrder" => "ASC"));

        foreach($Iodogs AS $menu)
        {
            $allContent[] = (object) array(
                        "parentId" => $menu->getParent(),
                        "id" => $menu->getId(),
                        "label" => $menu->getName(),
                        'params' => array('slug' => $menu->getHref()),
                        'route' => 'app/content',
                             );
        }
        $catalog = $this->getCatalog($serviceLocator);
        //print_r($catalog);
        $nestednodes = self::getChildren($allContent,0);
        foreach($nestednodes AS $node)
            {            
                if($node['params']['slug'] == 'catalog'){
                    $node['pages'] = $catalog;  
                    //$node['pages'] = array();  
                    //print_r($node);  
                }
                $configuration['navigation'][$this->getName()][] = $node;            
            }
       //print_r($configuration);
             
            if (!isset($configuration['navigation'])) {
                throw new \Exception('Could not find navigation configuration key');
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new \Exception(sprintf(
                    'Failed to find a navigation container by the name "%s"',
                    $this->getName()
                ));
            }
 
            $application = $serviceLocator->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);
 
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }
        return $this->pages;
    }
}