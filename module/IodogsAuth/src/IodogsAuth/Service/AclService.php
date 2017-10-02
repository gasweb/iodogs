<?php
namespace IodogsAuth\Service;

use Zend\Permissions\Acl\Acl as BaseAcl;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Permissions\Acl\Role\GenericRole as Role;

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

        $adminResources = array(
            'ProductAdminControllerFactory',
            'AdminContentController',
            'LineAdminControllerFactory',
            'AdminBreedControllerFactory',
            'CategoryAdminControllerFactory',
            'AdminProductImageControllerFactory',
            'InfoBlockAdminControllerFactory',
            'SolutionAdminControllerFactory',
            'ImageControllerFactory',
        );

        $guestResources = array(
            'OldApplicationController',
            'ContentControllerFactory',
            'AuthControllerFactory',
            'CatalogControllerFactory',
            'ProductControllerFactory',
            'LineControllerFactory',
            'BreedControllerFactory',
            'ReviewControllerFactory',
            'SolutionControllerFactory',
        );

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