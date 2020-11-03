<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\RegisterType;

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
        if($form->isSubmitted()){
            //modificando objeto para guardarlo
            $user->setRole('ROLE_USER');
            $user->setCreatedAt();
            $date_now =  (new \DateTime())->format('d-m-Y H:i:s');
            //cifranco la contraseña
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            var_dump($user);


        }



        return $this->render('user/register.html.twig', [
        	'form' => $form->createView()
        ]);
    }
}
