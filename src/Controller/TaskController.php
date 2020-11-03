<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
class TaskController extends AbstractController
{

    public function index()
    {

    	$em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(Task::class);
    	$tasks = $task_repo->findAll();


    	foreach($tasks as $task){
    		echo $task->getUser()->getEmail(). ' : '. $task->getTitle()."<br>";
    	}

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
