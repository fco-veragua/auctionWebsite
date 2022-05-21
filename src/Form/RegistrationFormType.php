<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('userName', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter User Name...'
                )
            ])
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter Name...'
                )
            ])
            ->add('lastName', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter Last Name...'
                )
            ])
            ->add('birthDate', DateType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => ''
                )
            ])
            ->add('country', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter Country...'
                )
            ])
            ->add('postalCode', IntegerType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => ''
                )
            ])
            ->add('streetAddress', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter Street Address...'
                )
            ])
            ->add('companyName', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter Company Name...'
                )
            ])
            ->add('phoneNumber', IntegerType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => ''
                )
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
