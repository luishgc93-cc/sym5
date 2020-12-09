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
use App\Entity\User;
use App\Repository\UserRepository;

class UserApi extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/usuarios")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function usuariosapi (User $user){
        
        
    return $user->findAll();


         
    }

}