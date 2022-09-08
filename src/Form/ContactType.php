<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class,[
                'label' => 'Votre nom et prénom',
                'constraints' => new Length(
                    [
                        'min'=> 2,
                        'max' =>30
                    ]
                ),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom et prénom'
                ]
            ])
            ->add('email', EmailType::class,[
                'constraints' => new Length( [
                    'min'=> 2,
                    'max' =>70
                ]),
                'label' => 'Votre email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email'
                ]
            ])
            ->add('subject', TextType::class,[
                'constraints' => new Length( [
                    'min'=> 2,
                    'max' =>100
                ]),
                'label' => 'Sujet de votre message',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre sujet'
                ]
                
            ])
            ->add('message', TextareaType::class,[
                'constraints' => new Length( [
                    'min'=> 2,
                    
                ]),
                'label' => 'Votre message',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre message'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr'=>[
                    'class'=>'btn btn-primary mt-4'
                ],
                'label'=> 'Soumetttre ma demande'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
