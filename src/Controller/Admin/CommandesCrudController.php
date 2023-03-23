<?php

namespace App\Controller\Admin;

use App\Entity\Commandes;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commandes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield MoneyField::new ('montant')->setCurrency('EUR')->setNumDecimals(0);
        yield ChoiceField::new ('statut')->setChoices([
            'Paid' => 'Paid',
            'Validated' => 'Validated',
            'Prepared' => 'Prepared',
            'Sent' => 'Sent',
            'Received' => 'Received'
        ]);
        yield DateField::new ('date_commande')->hideOnForm();
        yield AssociationField::new ('user_id')
        ->setFormTypeOptions(['by_reference' => false,]);


    }
}