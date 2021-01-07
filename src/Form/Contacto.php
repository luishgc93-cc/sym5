<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class Contacto extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('asunto', TextType::class, array(
            'label' => 'Asunto del Email'
        ))
        
        
            ->add('mensaje', TextareaType::class, array(
            'label' => 'Mensaje'
        ))
                   ->add('submit', SubmitType::class, array(
                                'label' => 'Enviar Email'
                            ));


    }
}