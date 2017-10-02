<?php
namespace IodogsProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsProduct\Form\ProductForm;
use IodogsApplication\Form\ConfirmForm;
use IodogsProduct\Form\ProductBreedForm;
use Zend\EventManager\EventManagerInterface;

class ProductAdminController extends AbstractActionController
{

    private $om;

    /**
     * @var \IodogsProduct\Service\ProductService
     */
    private $productService;

    public function __construct($objectManager, $productService)
    {
        $this->om = $objectManager;
        $this->productService = $productService;
    }

    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $controller->layout('layout/layout-admin');
        }, 100);
    }

    public function showAction()
    {
        $categoryId = (int) $this->params()->fromRoute('category', 0);
        $objectManager = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        if($categoryId)
        {
            $products = $objectManager->
            getRepository("\IodogsDoctrine\Entity\Product")->
            findBy(
                array('category' => $categoryId),
                array('sortOrder' => 'ASC')
            );
        }
        else
        { 
            $products = $objectManager->
            getRepository("\IodogsDoctrine\Entity\Product")->
            findBy(array(),array('sortOrder' => 'ASC'));
        }
        //print_r($products);
        return array("products" => $products);
    }
    public function addAction(){
        $objectManager = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $form = new ProductForm($objectManager);
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
         if ($request->isPost()){
             $form->setData($request->getPost());
             if ($form->isValid())
             {
                 $product = new \IodogsDoctrine\Entity\Product();
                 //$product->setDateUpdate();                 
                 $form->getHydrator()->hydrate($form->getData(), $product);
                 $objectManager->persist($product);
                 $objectManager->flush();

                 return $this->
                    redirect()->
                    toRoute('app/admin-product/id',
                        array(
                            'id' => $product->getId()
                            )
                        );
             }
         }
         return array('form' => $form);
        
    }

    public function deleteAction(){       
            $productId = (int) $this->params()->fromRoute('id', 0);


            if(!$productId){
                throw new \Exception("Идентификатор продукта не задан");            
            }
            else{
                $objectManager = $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');
                $product = $objectManager->find('IodogsDoctrine\Entity\Product', $productId);                   
                if(is_object($product)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $objectManager->remove($product);
                        $objectManager->flush();
                    }      
                    return $this->redirect()->toRoute('app/admin-product');
                } 

                    return array('form' => $form, 'product'=>$product);
                }
            }
        }

    public function editAction(){       
        $productId = (int) $this->params()->fromRoute('id', 0);
        if(!$productId){
            throw new \Exception("Идентификатор продукта не задан");            
        }
        else{
            $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
            $product = $objectManager->find('IodogsDoctrine\Entity\Product', $productId);                   
            if(is_object($product)){            
            $form = new productForm($objectManager);

            //$hydrator->extract($product,$form);
            $form->get('submit')->setValue('Edit');
            $form->bind($product);            
            //$form->setAttribute("id", $productId);
            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid())
                {
                    $this->om->persist($product);
                    $this->om->flush();
                    return $this->
                    redirect()->
                    toRoute('app/admin-product/id',
                        array(
                            'id' => $product->getId()
                            )
                        );

                }
            }
            //print_r($product->getBreed()[1]->getEngTitle());
            //print_r($product->getBreed()[2]->getEngTitle());
            return array('form' => $form, 'id'=>$productId, 'product' => $product);
        }
        else
        {
            throw new \Exception("Продукта с id $productId не найдено");           
        }
        }
    }
    public function breedAction(){       
            $productId = (int) $this->params()->fromRoute('id', 0);

            if(!$productId){
                throw new \Exception("Идентификатор продукта не задан");            
            }
            else{
                $Product = $this->productService->getProductById($productId);

//                $breedService = $this->getServiceLocator()->get('BreedServiceFactory');

                /*$breed = $breedService->getBreedById(1);
                $Product->addBreed($breed);

                $this->om->persist($Product);
                $this->om->flush();*/


                if($Product){
                    $viewArray = $this->productService->getViewArray($Product);
                $ProductBreedForm = new ProductBreedForm($this->om);
                    $ProductBreedForm->bind($Product);

                $request = $this->getRequest();
                if ($request->isPost()) {
                    $ProductBreedForm->setData($request->getPost());
                    if ($ProductBreedForm->isValid())
                    {
                        /*print_r($request->getPost());
                        $Product->setRusTitle('teest');
                        $breeds = $Product->getBreed();
                        foreach ($breeds AS $breed)
                        {
                            $Product->addBreed($breed);
                            echo $Product->getRusTitle()." a<br>";
                            echo $breed->getRusTitle().' - '.$breed->getId()."<br>";
                        }*/
                        $breeds = $Product->getBreed();
                        foreach ($breeds as $breed)
                        {
                            $breed->addProduct($Product);
                            $this->om->persist($breed);
                        }
                       //$this->om->persist($Product);

                        $this->om->flush();

//                        return $this->redirect()->refresh();

                    }
                }

                return array('form' => $ProductBreedForm, 'product' => $viewArray);
            }
            else
            {
                throw new \Exception("Продукта с id $productId не найдено");           
            }
            }
        }
}
