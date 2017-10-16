<?php
namespace IodogsCatalog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    IodogsCatalog\Form\LineForm,
    IodogsApplication\Form\ConfirmForm,
    Zend\Mvc\MvcEvent;

class LineAdminController extends AbstractActionController
{

    /** @var \Doctrine\ORM\EntityManager $om */
    private $om;
    
    public function __construct($om)
    {
        $this->om = $om;
    }

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
        $lines = $this->om->getRepository("\IodogsDoctrine\Entity\Line")->findAll();        
        return array("lines" => $lines);
    }
    
    public function deleteAction(){       
            $lineId = (int) $this->params()->fromRoute('lineId', 0);


            if(!$lineId){
                throw new \Exception("Идентификатор серии не задан");            
            }
            else{
                $line = $this->om->find('IodogsDoctrine\Entity\Line', $lineId);                   
                if(is_object($line)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $this->om->remove($line);
                        $this->om->flush();
                    }      
                    return $this->redirect()->toRoute('app/backoffice/line');
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
            $line = $this->om->find('IodogsDoctrine\Entity\Line', $lineId);                   
            if(is_object($line)){            
            $form = new LineForm($this->om);            
            $form->get('submit')->setValue('Edit');
            $form->bind($line);                       
            $request = $this->getRequest();
            if ($request->isPost()) {               
                $form->setData($request->getPost());
                if ($form->isValid()) {                    
                    $this->om->persist($line);
                    $this->om->flush();
                    return $this->
                    redirect()->
                    toRoute('app/backoffice/line/id',
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
            throw new \Exception("Продукта с id $lineId не найдено");
        }
        }
    }
    public function addAction(){
            $form = new lineForm($this->om);            
            $form->get('submit')->setValue('Добавить линию');        
            $request = $this->getRequest();
            if ($request->isPost()) {               
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $line = new \IodogsDoctrine\Entity\Line();                    
                    $form->getHydrator()->hydrate($form->getData(), $line);
                    $this->om->persist($line);
                    $this->om->flush();
                    return $this->
                    redirect()->
                    toRoute('app/backoffice/line/id',
                        array(
                            'id' => $line->getId()
                            )
                        );

                }
            }

            return array('form' => $form);
        }        
}
