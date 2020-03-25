<?php

namespace App\Form;

use App\Entity\Books;
use App\Entity\Batch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('status')
            ->add('description')
            ->add('batch',EntityType::class,[
                'required'=>true,
                'class'=>Batch::class,
                'placeholder'=>'Batch',
                'label'=>'Batch',
                'choice_label'=>function($batch){
                    return $batch->getId();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
