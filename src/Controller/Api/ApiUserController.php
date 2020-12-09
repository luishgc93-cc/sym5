<?php

namespace App\Controller\Api;

use App\Service\BookFormProcessor;
use App\Service\BookManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiUserController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/users")
     * @Rest\View(serializerGroups={"usuario"}, serializerEnableMaxDepthChecks=true)
     */
    public function usuarios (UserInterface $user){
        
        
                          
        $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(User::class);
    	$tasks = $task_repo->findAll();


         
    }

}