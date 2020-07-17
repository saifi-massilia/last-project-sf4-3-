<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'veuillez indiquer une adresse email']),
                    new Email(['message' => 'adresse email incorrecte']),
                ]
            ])
            ->add('pseudo',TextType::class,[
                'constraints'=> [
                    new NotBlank(['message'=>'veuillez indiquer un pseudo. ']),
                    new Length ([
                        'max' => 50,
                        'maxMessage' => 'le nom ne peut contenir plus de {{ limit }} caractères'
                    ])

                ]
            ])

            ->add('nom',TextType::class,[
                'constraints'=> [
                    new NotBlank(['message'=>'veuillez indiquer votre Nom. ']),
                    new Length ([
                        'max' => 50,
                        'maxMessage' => 'le nom ne peut contenir plus de {{ limit }} caractères'
                    ])
                ]
            ])

            ->add('prenom',TextType::class,[
                'constraints'=> [
                    new NotBlank(['message'=>'veuillez indiquer votre Prenom. ']),
                    new Length ([
                        'max' => 50,
                        'maxMessage' => 'le prenom ne peut contenir plus de {{ limit }} caractères'
                    ])
                ]
            ])




            ->add('telephone',TelType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
