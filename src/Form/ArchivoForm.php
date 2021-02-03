<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ArchivoForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) 
       {
        $builder
            ->add('fichero', FileType::class, [
                'multiple' => true,
                'attr'     => [
                    'multiple' => 'multiple'
                ]
            ])

            ->add('submit', SubmitType::class, array(
                'label' => 'Adjuntar Archivos'
            ));
        ;
    }
}