<?php

namespace App\Form;

use App\Entity\Marques;
use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('slug')
            ->add('categorie')
            ->add('description')
            ->add('prix')
            ->add('photoUrl')
            ->add('couleur')
            ->add('ref')
            ->add('commandes')
            ->add('category',EntityType::class,[
                'class' => Marques::class,
                'choice_label' => 'name',
                'multiple' => 'false',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
