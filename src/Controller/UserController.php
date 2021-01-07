<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Entity\Task;
use App\Form\RegisterType;
use App\Form\Modify;
use App\Form\UsuariosEditar;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Repository\UserRepository;




use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\ChangePasswordFormType;
use App\Form\ResetPasswordRequestFormType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //crear formulario
    	$user = new user();
    	$form = $this->createForm(RegisterType::class, $user);
        //rellenar el objeto con los datos del formulario
        $form->handleRequest($request);
        //comprobando si el formulario se ha enviado
        if($form->isSubmitted() && $form->isValid()){
            //modificando objeto para guardarlo
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \DateTime('now'));


            //cifranco la contrase�a
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

           	// guardar usuario
           	$em = $this->getDoctrine()->getManager();
           	$em->persist($user);
           	$em->flush();

           	return $this->redirectToRoute('tasks');


        }



        return $this->render('user/register.html.twig', [
        	'form' => $form->createView()
        ]);
    }


    public function login(AuthenticationUtils $autenticationUtils){
        $error = $autenticationUtils->getLastAuthenticationError();
        
        $lastUsername = $autenticationUtils->getLastUsername();
        
        return $this->render('user/login.html.twig', array(
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }

    public function modify(Request $request, User $user, UserPasswordEncoderInterface $encoder) 
    {
        $form = $this->createForm(Modify::class, $user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //$task->setUser($user);
           // $user->setRole('ROLE_USER');     
          //  $encoded = $encoder->encodePassword($user, $user->getPassword());
            //$user->setPassword($encoded);            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Perfil Modificado Correctamente');

            return $this->redirect($this->generateUrl('modify', ['id' => $user->getId()]));
        }


        return $this->render('user/modify.html.twig',[
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    
    
    
    public function usuarios (UserInterface $user){
        
        
        if(!$user || $user->getRole() !== 'ROLE_ADMIN'){
            return $this->redirectToRoute('tasks');
        }
                          
        $em = $this->getDoctrine()->getManager();
    	$task_repo = $this->getDoctrine()->getRepository(User::class);
    	$tasks = $task_repo->findAll();


        return $this->render('user/listado.html.twig', [
            'tasks' => $tasks
        ]);
         
    }
    

       public function usuarios_delete(User $user){


        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'USUARIO BORRADO CORRECTAMENTE');

          return $this->redirectToRoute('usuarios');

          // IMPORTANTE, "ON DELETE CASCADE" sin eso no podriamos borrar los usuarios ya que estan relacionados con las tareas, si a�adimos ese codigo en el sql nos borra el usuario y sus tareas.

    } 
    
    
    
    
        public function usuarios_ver(User $user){

        return $this->render('user/ver.html.twig',[
            'user' =>$user
               
                
        ]);
    }
    

    
  
    public function usuarios_editar(Request $request, User $user, UserPasswordEncoderInterface $encoder) 
    {
        $form = $this->createForm(UsuariosEditar::class, $user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //$task->setUser($user);
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'USUARIO EDITADO CORRECTAMENTE');

            return $this->redirect($this->generateUrl('usuarios_editar', ['id' => $user->getId()]));
        }


        return $this->render('user/usuarios_editar.html.twig',[
            'edit' => true,
            'form' => $form->createView()
        ]);
    }
    
    



    use ResetPasswordControllerTrait;

    private $resetPasswordHelper;

    public function __construct(ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->resetPasswordHelper = $resetPasswordHelper;
    }



    public function usuarios_editar_contraseña(MailerInterface $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder, User $user): Response
    {


       // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $email = (new Email())
            ->from('contacto@webcaceres.com')
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Contraseña Cambiada por el soporte informatico')
            ->text('Contraseña Cambiada por soporte informatico')
            ->html('<p>Se ha cambiado su contraseña por soporte informática.</p>');
    
        $mailer->send($email);

            // Encode the plain password, and set it.
            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

            // The session is cleaned up after the password has been changed.
            $this->addFlash('success', 'CONTRASEÑA RESTABLECIDA CORRECTAMENTE');

            return $this->redirectToRoute('usuarios');
        
        
        }





        return $this->render('reset_password/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);


    }

























}