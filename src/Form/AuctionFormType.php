<?php

namespace App\Form;

use App\Entity\Auction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AuctionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('state')
            ->add('price')
            ->add('startDate')
            ->add('closingDate')
            ->add('photosName', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove Photos',
                'download_label' => true,
                'download_uri' => true,
                'image_uri' => true,
                'imagine_pattern' => null,
                'asset_helper' => true,
            ])
            ->add('updateAt')
            ->add('category')
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auction::class,
        ]);
    }
}
