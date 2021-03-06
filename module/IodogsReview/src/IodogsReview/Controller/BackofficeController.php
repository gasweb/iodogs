<?php
namespace IodogsReview\Controller;

use Doctrine\ORM\EntityManager;
use IodogsApplication\Controller\AbstractApplicationController;
use IodogsReview\Service\ReviewService,
    IodogsReview\Form\ReviewForm;

class BackofficeController extends AbstractApplicationController
{
    private $om;
    private $reviewService;

    public function __construct(EntityManager $om, ReviewService $reviewService)
    {
        $this->om = $om;
        $this->reviewService = $reviewService;
    }

    public function addAction()
    {
        $ReviewForm = new ReviewForm($this->om);
        $request = $this->getRequest();
        if($request->isPost())
        {
            $Review = new \IodogsDoctrine\Entity\Review();
            $Review->setAddDate(new \DateTime("now"));
            $ReviewForm->bind($Review);
            $ReviewForm->setData($request->getPost());
            if($ReviewForm->isValid())
            {
                //$breed = $Review->get
                $this->om->persist($Review);
                $this->om->flush();


            }
            print_r($request->getPost());
        }

        return array(
            'reviewForm' => $ReviewForm
        );
    }
}