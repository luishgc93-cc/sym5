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

class UserApiController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/usuarios")
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function usuariosapi (UserInterface $user){
        
        
   $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(User::class);
    	$tasks = $task_repo->findAll();

         return $tasks;
    }

    
     /**
     * @Rest\Get(path="/usuarios/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function get_usuarios(int $id, UserInterface $user) {
        
        
     $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(User::class);
    	$tasks = $task_repo->find($id);
        
        if (!$tasks) {
            return View::create('USUARIO NO ENCONTRADO', Response::HTTP_BAD_REQUEST);
        }
        return $tasks;
    }   
    
    
}