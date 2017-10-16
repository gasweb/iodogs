<?php
namespace IodogsProduct\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Controller\ProductController;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 use IodogsProduct\Service\ProductService,
     IodogsReview\Service\ReviewService;

 class ProductControllerFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $productService = $container->get(ProductService::class);
         $reviewService = $container->get(ReviewService::class);


         return new ProductController($productService, $reviewService);
     }


 }