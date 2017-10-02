<?php
namespace IodogsApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsApplication\Form\ContentForm;
use IodogsApplication\Form\ContentFilter;
use IodogsApplication\Form\ConfirmForm;
use Zend\EventManager\EventManagerInterface;

class AdminContentController extends AbstractActionController
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
        $content = $objectManager->getRepository("\IodogsDoctrine\Entity\Content")->
        findBy(array(), array('title' => 'ASC'));
        //print_r($content);
        return array("content" => $content);
    }
    
    public function editAction(){       
        $contentId = (int) $this->params()->fromRoute('id', 0);
        if(!$contentId){
            throw new \Exception("Идентификатор материала не задан");            
        }
        else{
            $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
            $content = $objectManager->find('IodogsDoctrine\Entity\Content', $contentId);                   
            if(is_object($content)){            
            $form = new contentForm($objectManager);
            $form->bind($content);
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new ContentFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $content->setDateUpdate(new \DateTime("now"));
                    $objectManager->persist($content);
                    $objectManager->flush();
                    return $this->redirect()->refresh();

                }
            }

            return array('form' => $form, 'id'=>$contentId);
        }
        else
        {
            throw new \Exception("Продукта с id $productId не найдено");           
        }
        }
    }

    public function deleteAction(){       
            $contentId = (int) $this->params()->fromRoute('id', 0);


            if(!$contentId){
                throw new \Exception("Идентификатор материала не задан");            
            }
            else{
                $objectManager = $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');
                $content = $objectManager->find('IodogsDoctrine\Entity\Content', $contentId);                   
                if(is_object($content)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $objectManager->remove($content);
                        $objectManager->flush();
                    }      
                    return $this->redirect()->toRoute('app/admin-content');
                } 

                    return array('form' => $form, 'content'=>$content);
                }
            }
        }

    public function addAction(){       
        $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');                                
            $form = new contentForm($objectManager);            
            $form->get('submit')->setValue('Добавить материал');        
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new ContentFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $content = new \IodogsDoctrine\Entity\Content();
                    $content->setDateUpdate(new \DateTime("now"));
                    $form->getHydrator()->hydrate($form->getData(), $content);
                    $objectManager->persist($content);
                    $objectManager->flush();
                    return $this->
                    redirect()->
                    toRoute('app/admin-content/admin-content-id',
                        array(
                            'id' => $content->getId()
                            )
                        );

                }
            }

            return array('form' => $form);
        }
    public function indexAction()
    {
        return array();
    }
}
