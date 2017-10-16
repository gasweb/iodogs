<?php
namespace IodogsAuth\Service;

use Zend\Permissions\Acl\Acl as BaseAcl;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Permissions\Acl\Role\GenericRole as Role;

use IodogsApplication\Controller\Factory\AdminContentControllerFactory,
    IodogsApplication\Controller\AdminContentController,
    IodogsApplication\Controller\InfoBlockAdminController,
    IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\AdminProductImageController,
    IodogsBreed\Controller\AdminBreedController,
    IodogsFiles\Controller\ImageController,
    IodogsCatalog\Controller\CategoryAdminController,
    IodogsCatalog\Controller\SolutionAdminController,
    IodogsCatalog\Controller\LineAdminController;

/**
 * Acl service
 *
 */
class AclService extends BaseAcl
{
    /**
     * Construct
     * Define Acl keys.
     */
    public function __construct()
    {
        $this->addRole(new Role('Guest'));
        $this->addRole(new Role('Admin'), 'Guest');

        $adminResources = [
            ProductAdminController::class,
            AdminContentController::class,
            AdminContentControllerFactory::class,
            InfoBlockAdminController::class,
            LineAdminController::class,
            AdminBreedController::class,
            CategoryAdminController::class,
            AdminProductImageController::class,
            SolutionAdminController::class,
            ImageController::class,
        ];

        $guestResources = [
            'OldApplicationController',
            'ContentControllerFactory',
            'AuthControllerFactory',
            'CatalogControllerFactory',
            'ProductControllerFactory',
            'LineControllerFactory',
            'BreedControllerFactory',
            'ReviewControllerFactory',
            'SolutionControllerFactory',
        ];

        foreach ($adminResources as $adminResource) {
            $this->addResource(new Resource($adminResource));
        }

        foreach ($guestResources as $guestResource) {
            $this->addResource(new Resource($guestResource));
        }

        $this->allow('Admin', $adminResources);
        $this->allow('Guest', $guestResources);

    }
}