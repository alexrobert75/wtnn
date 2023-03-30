<?php

namespace App\Form;

use App\Data\ProductSearch;
use App\Entity\Marques;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', TextType::class, ['label' => false, 'required' => false, 'attr' => ['placeholder' => 'Search']])
            ->add('marque', EntityType::class, ['label' => false, 'required' => false, 'class' => Marques::class, 'expanded' => true, 'multiple' => true, 'choice_label' => 'nom'])
            ->add('prixmin', NumberType::class, ['label'=>false,'required'=>false,'attr'=>['placeholder' => 'Min price']])
            ->add('prixmax', NumberType::class, ['label'=>false,'required'=>false,'attr'=>['placeholder' => 'Max price']])
            ->add('submit', SubmitType::class, ['label' => 'Search'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductSearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return "";
    }
}