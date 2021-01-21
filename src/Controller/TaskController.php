<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use Symfony\Component\Security\Core\User\UserInterface;

use Knp\Component\Pager\PaginatorInterface;

use App\Entity\Adjunto;
use App\Form\ArchivoForm;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{

    public function index(  Request $request, PaginatorInterface $paginator)
    {

    	$em = $this->getDoctrine()->getManager();

    	$task_repo = $this->getDoctrine()->getRepository(Task::class);
    	$tasks = $task_repo->findBy([], ['id' =>'DESC']);

    	$task_repo2 = $this->getDoctrine()->getRepository(User::class);
        $tasks2 = $task_repo2->findBy([], ['id' =>'DESC']);


        $tasks = $paginator->paginate(
            $tasks, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );        
      
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'users' => $tasks2,

        ]);
    }




    public function detail(Task $task){
        if(!$task){
          return $this->redirectToRout('tasks');
        } 
        return $this->render('task/detail.html.twig',[
            'task' =>$task
        ]);
    }



public function creation(Request $request, UserInterface $user){
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            
            return $this->redirect($this->generateUrl('archivos', ['id' => $task->getId()]));
        }
        
        return $this->render('task/creation.html.twig',[
            'form' => $form->createView()
        ]);
    }



    public function myTasks(UserInterface $user){
        $tasks = $user->getTasks();
                
        return $this->render('task/my-tasks-personal.html.twig',[
            'tasks' => $tasks 
        ]); 
    }
    


    public function edit(Request $request, UserInterface $user, Task $task){

//        if(!$user || $user->getId() !== $task->getUser()->getId() ){

        if(!$user ){
            return $this->redirectToRoute('tasks');
        }

        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //$task->setCreatedAt(new \Datetime('now'));
            //$task->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            
            return $this->redirect($this->generateUrl('task_detail', ['id' => $task->getId()]));
        }


        return $this->render('task/creation.html.twig',[
            'edit' => true,
            'form' => $form->createView()
        ]);
    }



    public function delete(UserInterface $user, Task $task){

        //     if(!$user || $user->getId() !== $task->getUser()->getId()) {

                if(!$user) {
            return $this->redirectToRoute('tasks');
        }

        if(!$task){
          return $this->redirectToRout('tasks');
        }


        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();


          return $this->redirectToRoute('tasks');

    }

    public function addFiles(Request $request, Task $task) {

        $adjuntos = new Adjunto();
        $form = $this->createForm(ArchivoForm::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
           $attachments = $adjuntos;
    
            if ($attachments) {
                foreach($attachments as $attachment)
                {
                    $file = $attachment->getArchivo();
    
                    var_dump($attachment);
                    $filename = md5(uniqid()) . '.' .$file->guessExtension();
    
                    $file->move(
                            $this->getParameter('upload_path'), $filename
                    );
                    var_dump($filename);
                    $attachment->setArchivo($filename);
                }
                
            }
            $task->getId();
            $adjuntos->setAdjunto($task);
            $em = $this->getDoctrine()->getManager();
            $em->persist($adjuntos);

            $em->flush();
    
            return $this->redirectToRoute('task_detail', array('id' => $task->getId()));
        }

    
        return $this->render('task/archivos.html.twig', array(
                    'adjuntos' => $adjuntos,
                    'form' => $form->createView(),
        ));
    }



}
