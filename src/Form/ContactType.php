<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'attr'=>array(
                    'class'=> 'border-solid border w-full rounded px-3 py-2 my-2',
                    'placeholder'=> 'Votre nom ou société'
                )
            ))
            ->add('mail', EmailType::class, array(
                'attr'=>array(
                    'class'=> 'border-solid border w-full rounded px-3 py-2 my-2',
                    'placeholder'=> 'Votre mail'
                )
            ))
            ->add('message', TextareaType::class, array(
                'attr'=>array(
                    'class'=> 'border-solid border w-full rounded px-3 py-2 my-2',
                    'placeholder'=> 'Votre message'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
