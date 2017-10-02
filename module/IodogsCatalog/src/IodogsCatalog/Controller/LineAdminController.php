<?php
namespace IodogsCatalog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    IodogsCatalog\Form\LineForm,
    IodogsApplication\Form\ConfirmForm,
    Zend\Mvc\MvcEvent;

class LineAdminController extends AbstractActionController
{

    /**
    Функция меняет исходный layout для данного контроллера на админский layout
    **/

    public function onDispatch(MvcEvent $e)
    {
        $this -> layout('layout/layout-admin');
        return parent::onDispatch($e);
    }

    public function showAction()
    {
        $objectManager = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $lines = $objectManager->getRepository("\IodogsDoctrine\Entity\Line")->findAll();        
        return array("lines" => $lines);
    }
    
    public function deleteAction(){       
            $lineId = (int) $this->params()->fromRoute('lineId', 0);


            if(!$lineId){
                throw new \Exception("Идентификатор серии не задан");            
            }
            else{
                $objectManager = $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');
                $line = $objectManager->find('IodogsDoctrine\Entity\Line', $lineId);                   
                if(is_object($line)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $objectManager->remove($line);
                        $objectManager->flush();
                    }      
                    return $this->redirect()->toRoute('app/admin-line');
                } 

                    return array('form' => $form, 'line'=>$line);
                }
            }
        }

  public function editAction(){       
        $lineId = (int) $this->params()->fromRoute('lineId', 0);


        if(!$lineId){
            throw new \Exception("Идентификатор серии не задан");            
        }
        else{
            $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
            $line = $objectManager->find('IodogsDoctrine\Entity\Line', $lineId);                   
            if(is_object($line)){            
            $form = new LineForm($objectManager);            
            $form->get('submit')->setValue('Edit');
            $form->bind($line);                       
            $request = $this->getRequest();
            if ($request->isPost()) {               
                $form->setData($request->getPost());
                if ($form->isValid()) {                    
                    $objectManager->persist($line);
                    $objectManager->flush();
                    return $this->
                    redirect()->
                    toRoute('app/admin-line/admin-line-id',
                        array(
                            'lineId' => $line->getId()
                            )
                        );

                }
            }

            return array('form' => $form, 'line'=>$line);
        }
        else
        {
            throw new \Exception("Продукта с id $productId не найдено");           
        }
        }
    }
    public function addAction(){       
        $objectManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');                                
            $form = new lineForm($objectManager);            
            $form->get('submit')->setValue('Добавить линию');        
            $request = $this->getRequest();
            if ($request->isPost()) {               
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $line = new \IodogsDoctrine\Entity\Line();                    
                    $form->getHydrator()->hydrate($form->getData(), $line);
                    $objectManager->persist($line);
                    $objectManager->flush();
                    return $this->
                    redirect()->
                    toRoute('app/admin-line/admin-line-id',
                        array(
                            'id' => $line->getId()
                            )
                        );

                }
            }

            return array('form' => $form);
        }        
}
