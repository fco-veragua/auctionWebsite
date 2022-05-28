<?php

namespace App\Form;

use App\Entity\UserAuction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BidFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('bidDate')
            ->add('bidValue', IntegerType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter the value of your bid...'
                )
            ])
            //->add('auction')
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserAuction::class,
        ]);
    }
}
