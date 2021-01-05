<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Symfony\Component\Security\Core\User\UserInterface;


use Symfony\Component\Mime\Email;

/**
 * @Route("/reset-password")
 */
class Contraseña extends AbstractController
{
    use ResetPasswordControllerTrait;

    private $resetPasswordHelper;

    public function __construct(ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     *
     * @Route("/modificar", name="app_reset_password")
     */
    public function reset(MailerInterface $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder, UserInterface $user): Response
    {


       // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $this->setCanCheckEmailInSession(); // SACAMOS EL CORREO DE LA SESION ACTUAL DEL USUARIO, NOS SIRVE PARA ENVIARLE EMAILS POR EJEMPLO

            if (!$user) {
                return $this->redirectToRoute('app_check_email');
            }

            $email = (new Email())
            ->from('contacto@webcaceres.com')
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Contraseña Cambiada')
            ->text('Contraseña Cambiada')
            ->html('<p>Se ha cambiado su contraseña desde el panel de control, si usted no ha afectuado dicha opcion, contacte con nuestro soporte informatico en:</p>');
    
        $mailer->send($email);
        
        

            // Encode the plain password, and set it.
            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

            // The session is cleaned up after the password has been changed.

            return $this->redirectToRoute('tasks');
        
        
        }





        return $this->render('reset_password/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);


    }

}
