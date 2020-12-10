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
use App\Entity\Task;
use App\Repository\UserRepository;
use App\Entity\User;

class TareaApiController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/tareas")
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function tareasapi (){
        
        
   $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(Task::class);
    	$tasks = $task_repo->findAll();

         return $tasks;
    }

    
     /**
     * @Rest\Get(path="/tareas/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    public function get_tareas(int $id) {
        
        
     $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(Task::class);
    	$tasks = $task_repo->find($id);
        
        if (!$tasks) {
            return View::create('TAREA NO ENCONTRADA', Response::HTTP_BAD_REQUEST);
        }
        return $tasks;
    }   


     /**
     * @Rest\Get(path="/tareas/borrar/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"task"}, serializerEnableMaxDepthChecks=true)
     */
    
        public function delete_tareas(int $id, Task $task){
        

 
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();
               return View::create('TAREA  BORRADA', Response::HTTP_BAD_REQUEST);




        
    }    
}