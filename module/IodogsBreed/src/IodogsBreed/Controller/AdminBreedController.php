<?php
namespace IodogsBreed\Controller;

use IodogsBreed\Form\InputFilter\BreedProductInputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use IodogsBreed\Form\BreedForm;
use IodogsApplication\Form\ConfirmForm;
use IodogsBreed\Form\InputFilter\BreedFormFilter,
    IodogsBreed\Form\BreedProductForm,
    IodogsFiles\Form\ImageUploadForm;
use Zend\View\Helper\ViewModel;

class AdminBreedController extends AbstractActionController
{
    /**
     * @var \IodogsBreed\Service\BreedService
     */
    private $breedService;

    /**
     * @var \IodogsFiles\Service\ImageUploadService
     */
    private $imageUploadService;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $om;

    public function __construct($om, $breedService, $imageUploadService)
    {
        $this->om = $om;
        $this->breedService = $breedService;
        $this->imageUploadService = $imageUploadService;
    }


    public function showAction()
    {
        $breeds = $this->breedService->getBreeds();
        return array("breeds" => $breeds);
    }

    public function deleteAction(){
        $breedId = (int) $this->params()->fromRoute('breedId', 0);


        if(!$breedId){
            throw new \Exception("Идентификатор породы не задан");
        }
        else{
            $Breed = $this->breedService->getBreedById($breedId);
            $viewArray = $this->breedService->getViewArray($Breed);
            
            if($this->breedService->checkInstance($Breed))
            {
                $form = new ConfirmForm();

                $request = $this->getRequest();
                if ($request->isPost()){
                    $delete = $request->getPost('confirm-yes', 'no');
                    if($delete != "no")
                    {
                        $this->om->remove($Breed);
                        $this->om->flush();
                    }
                    return $this->redirect()->toRoute('app/backoffice/breed');
                }

                return array('form' => $form, 'viewArray'=>$viewArray);
            }
        }
    }

    public function imageUploadAction()
    {
        $breedId = (int) $this->params()->fromRoute('breedId', 0);
        $Breed = $this->breedService->getBreedById($breedId);
        $filePath = $this->breedService->getFilePath($Breed);
        $imageUploadForm = new ImageUploadForm();
        $breedViewArray = $this->breedService->getViewArray($Breed);

        $request = $this->getRequest();

        if($request->isPost())
        {
            $file =  $request->getFiles()->toArray();
            $fileName = (!empty($Breed->getFileName())) ?
                $Breed->getFileName()
                :
                $Breed->getId()."_".$Breed->getSlug().".jpg";


            $uploadResult = $this->imageUploadService->uploadBreedImage(
                array(
                    "file" => $file,
                    "upload_dir" => "breeds",
                    "file_name" => $fileName
                )
            );
            if($uploadResult['fileName'])
            {
                $Breed->setFileName($uploadResult['fileName']);
                $this->om->persist($Breed);
                $this->om->flush();
//                $this->redirect()->refresh();
                return $this->redirect()->toRoute('app/backoffice/breed/id', array('breedId' => $Breed->getId()));
            }
        }

        return array(
            'filePath' => $filePath,
            'uploadForm' => $imageUploadForm,
            'viewArray' => $breedViewArray
        );

    }

    public function editAction(){
        $breedId = (int) $this->params()->fromRoute('breedId', 0);


        if(!$breedId){
            throw new \Exception("Идентификатор породы не задан");
        }
        else{
            $Breed = $this->breedService->getBreedById($breedId);

            if($this->breedService->checkInstance($Breed)){

                $BreedForm = new BreedForm($this->om);

                $BreedForm->get('submit')->setValue('Редактировать');

                $BreedForm->bind($Breed);

                $request = $this->getRequest();

                if ($request->isPost())
                {
                    $BreedForm->setData($request->getPost());

                    $inputFilter = new BreedFormFilter();

                    $BreedForm->setInputFilter($inputFilter);

                    if ($BreedForm->isValid())
                    {

                        $this->om->persist($Breed);
                        $this->om->flush();
                        return $this->redirect()->toRoute('app/backoffice/breed/id',
                              array(
                                  'breedId' => $Breed->getId()
                                  )
                              );
                    }
                }

                $viewArray = $this->breedService->getViewArray($Breed);
                $imageUploadForm = new ImageUploadForm();


                return array(
                    'editForm' => $BreedForm,
                    'viewArray' => $viewArray,
                    'uploadForm' => $imageUploadForm
                );
            }
            else
            {
                throw new \Exception("Породы с id $breedId не найдено");
            }
        }
    }

    public function addAction(){

        $BreedForm = new BreedForm($this->om);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $BreedForm->setData($request->getPost());

            $inputFilter = new BreedFormFilter();

            $BreedForm->setInputFilter($inputFilter);

            if ($BreedForm->isValid()) {

                $Breed = new \IodogsDoctrine\Entity\Breed();
                $BreedForm->getHydrator()->hydrate($BreedForm->getData(), $Breed);

                $this->om->persist($Breed);

                $this->om->flush();

                return $this->redirect()->toRoute('app/backoffice/breed/id',
                    array(
                        'breedId' => $Breed->getId()
                    )
                );

            }
        }
        $viewArray = array();
        return array('editForm' => $BreedForm, 'viewArray' => $viewArray);
    }
    
    public function breedProductAction()
    {
        $breedId = $this->params()->fromRoute('breedId', 0);
        $Breed = $this->breedService->getBreedById($breedId);
        if($this->breedService->checkInstance($Breed))
        {
            $viewArray = $this->breedService->getViewArray($Breed);
            $BreedProductForm = new BreedProductForm($this->om);
            $BreedProductForm->bind($Breed);
            $request = $this->getRequest();

            if($request->isPost())
            {
                $BreedProductInputFilter = new BreedProductInputFilter();
                $BreedProductForm->setInputFilter($BreedProductInputFilter);
                $BreedProductForm->setData($request->getPost());
                if($BreedProductForm->isValid()){

                    $this->om->persist($Breed);

                    $this->om->flush();
                    $this->redirect()->refresh();
                }


            }

        }
        $this->flashMessenger()->addMessage('Message');
        return array(
            'breedProductForm' => $BreedProductForm,
            'viewArray' => $viewArray
        );
    }
}
