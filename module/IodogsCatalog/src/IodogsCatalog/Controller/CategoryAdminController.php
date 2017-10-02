<?php
namespace IodogsCatalog\Controller;

use IodogsApplication\Form\InfoBlock\InfoBlockForm;
use Zend\Mvc\Controller\AbstractActionController;
use IodogsCatalog\Form\CategoryForm;
use IodogsApplication\Form\ConfirmForm;
use IodogsCatalog\InputFilter\CategoryFilter;
use Zend\EventManager\EventManagerInterface;

class CategoryAdminController extends AbstractActionController
{


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
        $objectManager = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $categories = $objectManager->getRepository("\IodogsDoctrine\Entity\Category")->findAll();        
        return array("categories" => $categories);
    }
    
  public function editAction(){       
        $categoryId = (int) $this->params()->fromRoute('id', 0);


        if(!$categoryId){
            throw new \Exception("Идентификатор категории не задан");            
        }
        else{
            $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
            $category = $objectManager->find('IodogsDoctrine\Entity\Category', $categoryId);                   
            if(is_object($category)){            
            $form = new categoryForm($objectManager);            
            $form->get('submit')->setValue('Edit');
            $form->bind($category);                       
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new CategoryFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) {                    
                    $objectManager->persist($category);
                    $objectManager->flush();
                    return $this->
                    redirect()->
                    toRoute('app/admin-category/admin-category-id',
                        array(
                            'id' => $category->getId()
                            )
                        );

                }
            }

            return array('form' => $form, 'id'=>$categoryId);
        }
        else
        {
            throw new \Exception("Продукта с id $productId не найдено");           
        }
        }
    }

    public function infoBlockAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $categoryId = (int) $this->params()->fromRoute('id', 0);
        $Category = $objectManager->find('IodogsDoctrine\Entity\Category', $categoryId);
        $InfoBlockForm = new InfoBlockForm($objectManager);
        $InfoBlockForm->bind($Category);
        $request = $this->getRequest();
        if($request->isPost())
        {
            $InfoBlockForm->setData($Category);

        }
    }

    public function addAction(){       
        $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');                                
            $form = new categoryForm($objectManager);            
            $form->get('submit')->setValue('Добавить категорию');        
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new CategoryFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $category = new \IodogsDoctrine\Entity\Category();                    
                    $form->getHydrator()->hydrate($form->getData(), $category);
                    $objectManager->persist($category);
                    $objectManager->flush();
                    /*return $this->
                    redirect()->
                    toRoute('app/admin-category/admin-category-id',
                        array(
                            'id' => $category->getId()
                            )
                        );*/

                }
            }

            return array('form' => $form);
        }

    public function deleteAction(){   
            $categoryId = (int) $this->params()->fromRoute('id', 0);                


            if(!$categoryId){
                throw new \Exception("Идентификатор категории не задан");            
            }
            else{
                $objectManager = $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');
                $category = $objectManager->find('IodogsDoctrine\Entity\Category', $categoryId);                   
                if(is_object($category)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $objectManager->remove($category);
                        $objectManager->flush();
                    }      
                    return $this->redirect()->toRoute('app/admin-category');
                } 

                    return array('form' => $form, 'category'=>$category);
                }
            }
        }
        
}
