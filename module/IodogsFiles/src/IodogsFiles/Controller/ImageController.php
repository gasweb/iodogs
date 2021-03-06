<?php
namespace IodogsFiles\Controller;

use IodogsDoctrine\Entity\ImageStorage;
use IodogsFiles\Form\ImageEditForm;
use IodogsFiles\Form\Upload\ImageUploadForm;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    IodogsApplication\Form\ConfirmForm,
    Zend\EventManager\EventManagerInterface,
    IodogsFiles\InputFilter\ImageEditFilter,
    Imagick;

class ImageController extends AbstractActionController
{
    /** @var \IodogsFiles\Service\ImageService $imageService */
    private $imageService;

    /** @var |Interop\Container\ContainerInterface */
    private $sl;

    /** @var \Doctrine\ORM\EntityManager */
    private $om;

    public function __construct($imageService, $sl, $om)
    {
        $this->imageService = $imageService;
        $this->sl = $sl;
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

    public function deleteAction()
    {
        $imageId = (int) $this->params()->fromRoute('id',null);
        if($imageId)
        {

            $File = $this->imageService->getImageById($imageId);
            if($this->imageService->checkToEdit($File))
            {
                $src = $this->imageService->getViewArray($File);
                $confirmForm = new ConfirmForm();
                $request = $this->getRequest();


                if($request->isPost())
                {
                    $delete = $request->getPost('confirm-yes', 'no');
                    if($delete != 'no')
                    {
                        $this->imageService->deleteImageById($imageId);
                        return $this->redirect()->toRoute('app/backoffice/image/delete-success', array('id' => $imageId));
                    }
                }

                return array('confirmForm' => $confirmForm, 'file' => $File, 'src' => $src);
            }
            else
            {
                return $this->redirect()->toRoute('app/backoffice/image/delete-success', array('id' => $File->getId()));
            }
        }
    }
    
    public function editAction(){
        $imageId = (int) $this->params()->fromRoute('id', null);
        if($imageId)
        {
            $File = $this->imageService->getImageById($imageId);
            $fileViewArray = $this->imageService->getViewArray($File);
            if($this->imageService->checkToEdit($File))
            {
               $imageEditForm = new ImageEditForm($this->om);
                $imageEditForm->bind($File);
                $request = $this->getRequest();
                if($request->isPost()){
                    $ImageEditFilter = new ImageEditFilter();
                    $imageEditForm->setInputFilter($ImageEditFilter);
                    $imageEditForm->setData($request->getPost());
                    if ($imageEditForm->isValid()) {
                        $this->om->persist($File);
                        $this->om->flush();
                        return $this->redirect()->toRoute('app/backofice/image',
                            array(
                                'id' => $File->getId()
                            )
                        );

                    }
                    else echo "no valid";
                }
               return array("imageEditForm" => $imageEditForm, "file" => $fileViewArray);
            }
        }
    }

    public function deleteSuccessAction()
    {
        return (new ViewModel());
    }

    public function uploadAction()
    {
        /** @var \IodogsFiles\Form\Upload\ImageUploadForm $ImageUploadForm */
        $ImageUploadForm = new ImageUploadForm();
        $messages = [];
        $images = $this->imageService->getImages();
        /** @var \Zend\Http\PhpEnvironment\Request $request */
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $ImageUploadForm->setData($postData);
            if ($ImageUploadForm->isValid())
            {
                $data = $ImageUploadForm->getData();
                if (isset($data['image_file']) && is_array($data['image_file']))
                {
                    $images = $this->imageService->uploadImages($data['image_file']);
                    $this->redirect()->refresh();
                }

            } else{
                $messages = $ImageUploadForm->getMessages();
            }
        }
        return new ViewModel(
            [
                'form' => $ImageUploadForm,
                'messages' => $messages,
                'images' => $images,
            ]
        );
    }

}