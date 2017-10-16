<?php
namespace IodogsApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsApplication\Form\ContentForm;
use IodogsApplication\Form\ContentFilter;
use IodogsApplication\Form\ConfirmForm;
use Zend\EventManager\EventManagerInterface;

//Entity use block
use IodogsDoctrine\Entity\Content;

class AdminContentController extends AbstractActionController
{
    /** @var \Doctrine\ORM\EntityManager $entityManager */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
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
        $content = $this->entityManager->getRepository(Content::class)->
        findBy([], ['title' => 'ASC']);
        return ["content" => $content];
    }
    
    public function editAction(){       
        $contentId = (int) $this->params()->fromRoute('id', 0);
        if(!$contentId){
            throw new \Exception("Идентификатор материала не задан");            
        }
        else{
            $content = $this->entityManager->find('IodogsDoctrine\Entity\Content', $contentId);                   
            if(is_object($content)){            
            $form = new contentForm($this->entityManager);
            $form->bind($content);
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new ContentFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $content->setDateUpdate(new \DateTime("now"));
                    $this->entityManager->persist($content);
                    $this->entityManager->flush();
                    return $this->redirect()->refresh();

                }
            }

            return array('form' => $form, 'id'=>$contentId);
        }
        else
        {
            throw new \Exception("Материала с id $contentId не найдено");
        }
        }
    }

    public function deleteAction(){       
            $contentId = (int) $this->params()->fromRoute('id', 0);


            if(!$contentId){
                throw new \Exception("Идентификатор материала не задан");            
            }
            else{
                $content = $this->entityManager->find('IodogsDoctrine\Entity\Content', $contentId);                   
                if(is_object($content)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $this->entityManager->remove($content);
                        $this->entityManager->flush();
                    }      
                    return $this->redirect()->toRoute('app/backoffice/content');
                } 

                    return array('form' => $form, 'content'=>$content);
                }
            }
        }

    public function addAction(){
            $form = new contentForm($this->entityManager);
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
                    $this->entityManager->persist($content);
                    $this->entityManager->flush();
                    return $this->
                    redirect()->
                    toRoute('app/backoffice/content/id',
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
