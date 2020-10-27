<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{




    public function index()
    {


	$em = $this->getDoctrine()->getManager();
	$tak_repo = $this->getDoctrine()->getRepository(Task::class);
	$tasks = $task_repo->findAll();

	foreach($tasks as $task){
		echo $task->getTittle()."<br>";
	}


    	
        return $this->render('taks/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
