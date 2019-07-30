<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('userType', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'choices' => [
                    'Student' => 1,
                    'Institute' => 2,
                    'Company' => 3
                ]
            ))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => "Password",
                ],
                'second_options' => [
                    'label' => 'Repeat Password'
                ],
                'options' => ['attr' => array('class' => 'form-control') ],
                'required' => true
            ])
            ->add('Register', SubmitType::class, array('label' => 'Register', 'attr' => array('class' => 'btn btn-primary mt-3')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
