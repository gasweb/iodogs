<?php
namespace IodogsApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsApplication\Form\InfoBlock\InfoBlockForm;
use Zend\EventManager\EventManagerInterface;

class InfoBlockAdminController extends AbstractActionController
{

    private $om;

    public function __construct($om)
    {
        $this->om = $om;
    }

    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $controller->layout('layout/layout-admin');
        }, 100);
    }


    public function editAction(){
        $infoBlockId = (int) $this->params()->fromRoute('id', 0);
        if(!$infoBlockId){
            throw new \Exception("Идентификатор материала не задан");
        }
        else{
            $InfoBlock = $this->om->find('IodogsDoctrine\Entity\InfoBlock', $infoBlockId);
            $InfoBlockForm = new InfoBlockForm($this->om);
            if(is_object($InfoBlock)){
                $InfoBlockForm->bind($InfoBlock);
                $request = $this->getRequest();
                if ($request->isPost()) {
//                    $inputFilter = new ContentFilter();
//                    $form->setInputFilter($inputFilter);
                    $InfoBlockForm->setData($request->getPost());
                    if ($InfoBlockForm->isValid()) {
                        $InfoBlock->setDateUpdate(new \DateTime("now"));
                        $this->om->persist($InfoBlock);
                        $this->om->flush();
                        return $this->redirect()->refresh();

                    }
                }

                return array('infoBlockForm' => $InfoBlockForm, 'infoBlock'=>$InfoBlock);
            }
            else
            {
                throw new \Exception("Продукта с id $productId не найдено");
            }
        }
    }

    public function addAction(){
        $InfoBlockForm = new InfoBlockForm($this->om);
        $request = $this->getRequest();
        if ($request->isPost()) {
//            $inputFilter = new ContentFilter();
//            $form->setInputFilter($inputFilter);
            $InfoBlockForm->setData($request->getPost());
            if ($InfoBlockForm->isValid()) {
                $InfoBlock = new \IodogsDoctrine\Entity\InfoBlock();
                $InfoBlock->setDateUpdate(new \DateTime("now"));
                $InfoBlockForm->getHydrator()->hydrate($InfoBlockForm->getData(), $InfoBlock);
                $this->om->persist($InfoBlock);
                $this->om->flush();
                return $this->
                redirect()->
                toRoute('app/admin-info-block/edit',
                    array(
                        'id' => $InfoBlock->getId()
                    )
                );

            }
        }

        return array('infoBlockForm' => $InfoBlockForm);
    }

    public function showAction()
    {
        $infoBlocks = $this->om->getRepository('IodogsDoctrine\Entity\InfoBlock')->
        findBy(array(), array('title' => 'ASC'));
        return array("infoBlocks" => $infoBlocks);
    }
}
