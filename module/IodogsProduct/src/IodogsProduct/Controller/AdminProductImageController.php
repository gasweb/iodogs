<?php
namespace IodogsProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsFiles\Form\ImageUploadForm,
    Zend\EventManager\EventManagerInterface,
    IodogsFiles\Form\ImageEditForm;

/*use IsleAdmin\Form\ProductImageForm;*/

class AdminProductImageController extends AbstractActionController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $om;
    /**
     * @var \IodogsFiles\Service\ImageUploadService
     * */
    private $imageUploadService;
    /**
     * @var \IodogsProduct\Service\ProductService
     * */
    private $productService;

    /**
     * @param EventManagerInterface $events
     */
    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $controller->layout('layout/layout-admin');
        }, 100);
    }

    /**
     * AdminProductImageController constructor.
     * @param $om
     * @param $imageUploadService
     * @param $productService
     */
    public function __construct($om, $imageUploadService, $productService)
    {
        $this->om = $om;
        $this->imageUploadService = $imageUploadService;
        $this->productService = $productService;
    }

    public function addAction()
    {
        $productId = null;
        $fileErrors = null;
        $ProductImages = null;

        $productId = (int) $this->params()->fromRoute('id', 0);

        if(!$productId){
            throw new \Exception("Идентификатор продукта не указан", 1);
        }
        elseif($productId)
        {

            $request = $this->getRequest();

            if($request->isPost())
            {

                //Получаем массив загружаемых файлов
                $files =  $request->getFiles()->toArray();

                $uploadResult = $this->imageUploadService->uploadFiles(
                    [
                        "files" => $files,
                        "upload_dir" => "product$productId"
                    ]
                );
                $fileErrors = $uploadResult['fileUploadErrors'];
                $filesUploaded = $uploadResult['upload_id'];

                if(is_array($filesUploaded) && $filesUploaded)
                {

                    $Product = $this->productService->getProductById($productId);


                    foreach($filesUploaded AS $fileId)
                    {
                        $File = $this->om->
                        getRepository("\IodogsDoctrine\Entity\FileStorage")->
                        findOneBy(
                            array(
                                'id' => $fileId
                            )
                        );
                        $Product->addFile($File);
                        $this->om->persist($Product);
                    }
                    $this->om->flush();
                }
            }

            return $this->
            redirect()->
            toRoute('app/backoffice/product/id/image',
                [
                    'id' => $productId
                ]
            );
        }
    }
    

    public function showAction()
    {
        $productImages = null;
        $productId = null;

        $productId = (int) $this->params()->fromRoute('id', 0);

        if(!$productId){
            throw new \Exception("Идентификатор продукта не указан", 1);
        }
        elseif($productId)
        {

            $form = new ImageUploadForm('upload-form');

            $Product = $this->productService->getProductById($productId);
            $productImages = $this->productService->getImagesView($Product,false);
            


            return [
                'form' => $form,
                "productFiles" => $productImages,
                "Product" => $Product,
                "productId" => $productId,
            ];
        }
    }

}
