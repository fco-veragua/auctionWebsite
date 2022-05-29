<?php

namespace App\Form;

use App\Entity\Auction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AuctionJewelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter title...'
                )
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter description...'
                )
            ])
            ->add('state', TextType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter state...'
                )
            ])
            ->add('price', IntegerType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => 'Enter price...'
                )
            ])
            //->add('startDate')
            ->add('closingDate', DateTimeType::class, [
                'attr' => array(
                    'class' => '',
                    'placeholder' => ''
                )
            ])
            ->add('photosFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove Photos',
                'download_label' => true,
                'download_uri' => true,
                'image_uri' => true,
                'imagine_pattern' => null,
                'asset_helper' => true,
            ])
            //->add('updateAt')
            //->add('category')
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auction::class,
        ]);
    }
}
