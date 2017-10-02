<?php
namespace IodogsApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class SearchController extends AbstractActionController
{

    public function __construct($sl)
    {
        $this->sl = $sl;
    }

    public function indexAction()
    {
        //sleep(1);

        $breedService = $this->sl->get('BreedServiceFactory');
        $breeds = $breedService->getBreeds();
        $breedArray = $breedService->getViewInfoByArray($breeds);

        $query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;

        if (!isset($query)) {
            die('Invalid query.');
        }

        $status = true;
        $databaseUsers = array(
            array(
                "id"        => 1,
                "title"  => "Тестовый заголовок",
                "img"    => "https://avatars2.githubusercontent.com/u/4152589",
                'slug' => 'slug'
            ),
        );


      /*  $databaseProjects = array(
            array(
                "id"        => 1,
                "project"   => "jQuery Typeahead",
                "image"     => "http://www.runningcoder.org/assets/jquerytypeahead/img/jquerytypeahead-preview.jpg",
                "version"   => "1.7.0",
                "demo"      => 10,
                "option"    => 23,
                "callback"  => 6,
            ),
            array(
                "id"        => 2,
                "project"   => "jQuery Validation",
                "image"     => "http://www.runningcoder.org/assets/jqueryvalidation/img/jqueryvalidation-preview.jpg",
                "version"   => "1.4.0",
                "demo"      => 11,
                "option"    => 14,
                "callback"  => 8,
            )
        );

        $resultProjects = [];
        foreach ($databaseProjects as $key => $oneProject) {
            if (strpos(strtolower($oneProject["project"]), $query) !== false) {
                $resultProjects[] = $oneProject;
            }
        }*/

// Means no result were found
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