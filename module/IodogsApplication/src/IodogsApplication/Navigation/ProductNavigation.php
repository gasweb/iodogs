<?php
namespace IodogsApplication\Navigation;

use Interop\Container\ContainerInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class ProductNavigation extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'product-nav';
    }

    protected function getCatalog(ContainerInterface $container)
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
        $objectManager = $container
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
                    'route' => 'app/catalog/category-slug',
                );
                foreach($lines AS $line)
                {
                    $categoryMenuItem['pages'][$line->getId()] = array(
                        "label" => $line->getTitle(),
                        'params' => array('slug' => $line->getSlug()),
                        'route' => 'app/line/slug',
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
                                'route' => 'app/product',
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

    protected function getPages(ContainerInterface $container)
    {
        if (null === $this->pages){
            $catalog = $this->getCatalog($container);
            $configuration['navigation'][$this->getName()] = $catalog;

            if (!isset($configuration['navigation'])) {
                throw new \Exception('Could not find navigation configuration key');
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new \Exception(sprintf(
                    'Failed to find a navigation container by the name "%s"',
                    $this->getName()
                ));
            }

            $application = $container->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);

            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }
        return $this->pages;
    }
}