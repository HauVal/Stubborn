<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('price', IntegerType::class, ['label' => 'Prix'])
            ->add('stockXs', IntegerType::class, ['label' => 'Stock XS'])
            ->add('stockS', IntegerType::class, ['label' => 'Stock S'])
            ->add('stockM', IntegerType::class, ['label' => 'Stock M'])
            ->add('stockL', IntegerType::class, ['label' => 'Stock L'])
            ->add('stockXl', IntegerType::class, ['label' => 'Stock XL'])
            ->add('highlight', CheckboxType::class, [
                'label' => 'Mettre en avant',
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

