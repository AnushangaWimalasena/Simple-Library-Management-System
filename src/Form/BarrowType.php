<?php

namespace App\Form;

use App\Entity\Barrow;
use App\Entity\User;
use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BarrowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('barrowDate')
            ->add('dueDate')
            ->add('user',EntityType::class,[
                'required'=>true,
                'class'=>User::class,
                'placeholder'=>'User',
                'choice_label'=>function($user){
                    return $user->getFName();
                }
            ])
            ->add('book',EntityType::class,[
                'required'=>true,
                'class'=>Books::class,
                'placeholder'=>'Book',
                'choice_label'=>function($book){
                    return $book->getId();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Barrow::class,
        ]);
    }
}
