<?php
namespace IodogsCatalog\Controller;

use IodogsApplication\Form\InfoBlock\InfoBlockForm;
use Zend\Mvc\Controller\AbstractActionController;
use IodogsCatalog\Form\CategoryForm;
use IodogsApplication\Form\ConfirmForm;
use IodogsCatalog\InputFilter\CategoryFilter;
use Zend\EventManager\EventManagerInterface;
use IodogsDoctrine\Entity\Category;

class CategoryAdminController extends AbstractActionController
{
    
    /** @var \Doctrine\ORM\EntityManager $om */
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

    public function showAction()
    {
        $categories = $this->om->getRepository("\IodogsDoctrine\Entity\Category")->findAll();        
        return array("categories" => $categories);
    }
    
  public function editAction(){       
        $categoryId = (int) $this->params()->fromRoute('id', 0);


        if(!$categoryId){
            throw new \Exception("Идентификатор категории не задан");            
        }
        else{
            $category = $this->om->find('IodogsDoctrine\Entity\Category', $categoryId);                   
            if(is_object($category)){            
            $form = new categoryForm($this->om);            
            $form->get('submit')->setValue('Edit');
            $form->bind($category);                       
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new CategoryFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) {                    
                    $this->om->persist($category);
                    $this->om->flush();
                    return $this->
                    redirect()->
                    toRoute('app/backoffice/category/id',
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
            throw new \Exception("Продукта с id $categoryId не найдено");
        }
        }
    }

    public function infoBlockAction()
    {
        $categoryId = (int) $this->params()->fromRoute('id', 0);
        $Category = $this->om->find(Category::class, $categoryId);
        $InfoBlockForm = new InfoBlockForm($this->om);
        $InfoBlockForm->bind($Category);
        $request = $this->getRequest();
        if($request->isPost())
        {
            $InfoBlockForm->setData($Category);

        }
    }

    public function addAction(){
            $form = new categoryForm($this->om);            
            $form->get('submit')->setValue('Добавить категорию');        
            $request = $this->getRequest();
            if ($request->isPost()) {
                $inputFilter = new CategoryFilter();
                $form->setInputFilter($inputFilter);
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $category = new \IodogsDoctrine\Entity\Category();                    
                    $form->getHydrator()->hydrate($form->getData(), $category);
                    $this->om->persist($category);
                    $this->om->flush();
                    return $this->
                    redirect()->
                    toRoute('app/backoffice/category/id',
                        array(
                            'id' => $category->getId()
                            )
                        );

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
                $category = $this->om->find(Category::class, $categoryId);
                if(is_object($category)){   
                    $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){   
                    $delete = $request->getPost('confirm-yes', 'no');                      
                    if($delete != "no")
                    {
                        $this->om->remove($category);
                        $this->om->flush();
                    }      
                    return $this->redirect()->toRoute('app/backoffice/category');
                } 

                    return array('form' => $form, 'category'=>$category);
                }
            }
        }
        
}
