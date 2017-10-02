<?php
namespace IodogsCatalog\Controller;

use IodogsCatalog\Form\SolutionForm;
use IodogsCatalog\Form\SolutionProductForm;
use IodogsCatalog\InputFilter\SolutionFormInputFilter;
use IodogsCatalog\Service\SolutionService;
use Zend\Mvc\Controller\AbstractActionController,
    IodogsCatalog\Form\LineForm,
    IodogsApplication\Form\ConfirmForm,
    Zend\Mvc\MvcEvent;

class SolutionAdminController extends AbstractActionController
{
    private $om;

    /**
     * @var SolutionService
     */
    private $solutionService;

    public function __construct($om, $solutionService)
    {
        $this->om = $om;
        $this->solutionService = $solutionService;
    }

    /**
    Функция меняет исходный layout для данного контроллера на админский layout
     **/

    public function onDispatch(MvcEvent $e)
    {
        $this->layout('layout/layout-admin');
        return parent::onDispatch($e);
    }

    public function showAction()
    {
        $objectManager = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $solutions = $objectManager->getRepository('\IodogsDoctrine\Entity\Solution')->findAll();
        return array("solutions" => $solutions);
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
        $id = (int) $this->params()->fromRoute('id', 0);


        if(!$id){
            throw new \Exception("Идентификатор не задан");
        }
        else{
            $solution = $this->om->find('IodogsDoctrine\Entity\Solution', $id);
            if(is_object($solution))
            {
                $solutionForm = new SolutionForm($this->om);
                $solutionForm->get('submit')->setValue('Редактировать');
                $solutionForm->bind($solution);
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $solutionFormInputFilter = new SolutionFormInputFilter();
                    $solutionForm->setInputFilter($solutionFormInputFilter);
                    $solutionForm->setData($request->getPost());
                    if ($solutionForm->isValid()) {
                        $this->om->persist($solution);
                        $this->om->flush();
                        return $this->redirect()->refresh();
                    }
                }
                $solutionProductForm = new SolutionProductForm($this->om);
                $solutionProductForm->bind($solution);

                return array(
                    'solutionForm' => $solutionForm,
                    'solution' => $solution,
                    'solutionProductForm' => $solutionProductForm,
                );
            }
            else
            {
                throw new \Exception("Сущности с id $id не найдено");
            }
        }
    }

    public function productAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $Solution = $this->solutionService->getSolutionById($id);

        $products = $Solution->getProduct();
        foreach ($products as $product) {
            echo $product->getId();
        }
//        die;

        if($this->solutionService->checkInstance($Solution))
        {
            $viewArray = $this->solutionService->getViewArray($Solution);

            $solutionProductForm = new SolutionProductForm($this->om);
            $solutionProductForm->bind($Solution);
            $request = $this->getRequest();

            if($request->isPost())
            {
                $solutionProductForm->setData($request->getPost());


                if($solutionProductForm->isValid()){


                    $solutionProductForm->getHydrator()->hydrate(array('productId' => 1), $Solution);

                    $this->om->persist($Solution);
                    $this->om->flush();
                    $this->redirect()->toRoute('app/admin-solution/edit', array('id' => $Solution->getId()));
                }
            }
        }

        return array(
            'solutionProductForm' => $solutionProductForm,
            'solution' => $viewArray
        );
    }


    public function addAction()
    {
        $solutionForm = new SolutionForm($this->om);
        $solutionForm->get('submit')->setValue('Добавить линию');
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $solutionForm->setData($request->getPost());
            $solutionFormInputFilter = new SolutionFormInputFilter();
            $solutionForm->setInputFilter($solutionFormInputFilter);
            if ($solutionForm->isValid()) {
                $solution = new \IodogsDoctrine\Entity\Solution();
                $solutionForm->getHydrator()->hydrate($solutionForm->getData(), $solution);
                $this->om->persist($solution);
                $this->om->flush();
                return $this->
                redirect()->
                toRoute('app/admin-solution/edit',
                    array(
                        'id' => $solution->getId()
                        )
                    );
            }
        }

        return array('solutionForm' => $solutionForm);
    }
}
