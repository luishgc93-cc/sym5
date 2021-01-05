<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuariosEditar extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name', TextType::class, array(
            'label' => 'Nombre'
        ))


                ->add('surname', TextType::class, array(
                            'label' => 'Apellidos'
                        ))
                ->add('email', EmailType::class, array(
                            'label' => 'Correo Electronico'
                        ))

                        ->add('role', ChoiceType::class, array(
                            'label' => 'Rol',
                            'choices' => array(
                                'Usuario' => 'ROLE_USER',
                                'Administrador' => 'ROLE_ADMIN',
                            )
                        ))

                    ->add('submit', SubmitType::class, array(
                                'label' => 'Modificar Usuario'
                            ));


    }
}