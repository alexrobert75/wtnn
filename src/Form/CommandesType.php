<?php

namespace App\Form;

use App\Entity\Commandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant')
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'Paid' => 'Paid',
                    'Validated' => 'Validated',
                    'Prepared' => 'Prepared',
                    'Sent' => 'Sent',
                    'Received' => 'Received'
                ],])
            ->add('date_commande')
            ->add('user_id')
            ->add('produits_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
