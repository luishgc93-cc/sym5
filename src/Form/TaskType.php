<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TaskType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('title', TextType::class, array(
            'label' => 'Titulo'
        ))
        ->add('content', TextareaType::class, array(
            'label' => 'Contenido'
        ))
        ->add('priority', ChoiceType::class, array(
            'label' => 'Prioridad',
            'choices' => array(
                'Alta' => 'high',
                'Media' => 'medium',
                'Baja' => 'low'
            )
        ))
        ->add('hours', NumberType::class, array(
            'label' => 'Horas presupuestadas'
        ))
        ->add('estado', ChoiceType::class, array(
            'label' => 'Estado',
            'choices' => array(
                'Estudiando' => '1',
                'Empezando' => '2',
                'A medias' => '3',
                'Acabando' => '4',
                'FINALIZADO' => '5'

            )
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Guardar'
        ));
    }
    
}