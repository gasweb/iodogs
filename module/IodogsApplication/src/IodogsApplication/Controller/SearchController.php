<?php
namespace IodogsApplication\Controller;

use IodogsBreed\Service\BreedService;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class SearchController extends AbstractActionController
{
    /** @var \Psr\Container\ContainerInterface $container */
    private $container;

    /** @var \IodogsBreed\Service\BreedService $breedService */
    private $breedService;

    public function __construct($container)
    {
        $this->container = $container;
        $this->breedService = $this->container->get(BreedService::class);
    }

    public function indexAction()
    {
        $breeds = $this->breedService->getBreeds();
        $breedArray = $this->breedService->getViewInfoByArray($breeds);

        $query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;

        if (!isset($query)) {
            die('Invalid query.');
        }

        $status = true;

        if (empty($breedArray) && empty($resultProjects)) {
            $status = false;
        }

        header('Content-Type: application/json');

        echo json_encode(array(
            "status" => $status,
            "error"  => null,
            "data"   => array(
                "breed"      => $breedArray
//                "project"   => $resultProjects
            )
        ));
        die;
    }
}