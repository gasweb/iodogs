<?php
namespace IodogsApplication\Controller;

use IodogsApplication\Form\ContactForm;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    IodogsApplication\Form\InputFilter\ContactFormInputFilter,
    Zend\Mail,
    Zend\Mail\Transport\Sendmail,
    IodogsCatalog\Service\LineService;

/**
 * Default action for module
 * Get ContentEntity by page slug and return array for view
 */

class ContentController extends AbstractActionController
{
    private $contentService;
    private $sl;

    public function __construct($ContentService, $sl)
    {
        $this->contentService = $ContentService;
        $this->sl = $sl;
    }

    /**
     * @return array|void
     */
    public function slugAction()
    {
        $slug = $this->params()->fromRoute('slug', 0);
        $pageContent = $this->contentService->findPageBySlug($slug);
        $viewArray = $this->contentService->getViewArray($pageContent);
        if(!empty($viewArray))
        {
            $dateUpdate = $viewArray['date_update'];
            $dateUpdate->setTimeZone(new \DateTimeZone("GMT-0"));
            $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Expires', date("D, j M Y", strtotime("tomorrow")) . " 02:00:00 GMT");
            $response->getHeaders()->addHeaderLine('Last-Modified', $dateUpdate->format('D, d M Y H:i:s \G\M\T'));
            return array(
                "page" => $viewArray,
            );
        }


        $this->getResponse()->setStatusCode(404);
        return;
    }

    public function regionAction(){
        $subdomain = $this->params()->fromRoute('sub', null);

        /*
        return array(
            'sub' => $subdomain,
        );
        */
        $view = new ViewModel();
        $view->setTemplate('iodogs-application/content/home.phtml');
        return $view;


    }

    public function messageSentAction(){
        return new ViewModel();
    }

    public function buyAction(){
        return new ViewModel();
    }

    public function wholesaleAction(){
        $this->redirect()->toRoute('app/contacts')->setStatusCode(301);
        return;
    }



    public function videoAction(){
        return new ViewModel();
    }

    public function contactsAction(){

        $ContactForm = new ContactForm();
        $request = $this->getRequest();
        if($request->isPost())
        {
            $ContactFormInputFilter = new ContactFormInputFilter();
            $ContactForm->setInputFilter($ContactFormInputFilter);
            $postData = $request->getPost();
            $ContactForm->setData($postData);
            if($ContactForm->isValid())
            {
                $header = (!empty($postData['header'])) ? $postData['header'] : 'iodogs: сообщение из формы контактов';

                $om = $this->sl->get('Doctrine\ORM\EntityManager');
                $ContactFormEntity = new \IodogsDoctrine\Entity\ContactForm();
                $ContactFormEntity->setDateAdd(new \DateTime("now"));
                $ContactForm->getHydrator()->hydrate($ContactForm->getData(), $ContactFormEntity);
                $om->persist($ContactFormEntity);
                $om->flush();

                $mail = new Mail\Message();
                $mail->setEncoding('UTF-8');
                $mail->setBody($postData['message']);
                $mail->setFrom($postData['email'], $postData['name']);
                $mail->addTo('big-papa@mail.ru', 'Gas Smith');
                $mail->setSubject($header);
                $transport = new Sendmail();
                $transport->send($mail);

                return $this->
                redirect()->
                toRoute('app/message-sent');
            }
        }

        return array(
            'contactsForm' => $ContactForm
        );
    }


    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function homeAction()
    {
        $lineService = $this->sl->get(LineService::class);
        $lines = $lineService->getLinesArray();
        return (array("lines" => $lines));
    }
}