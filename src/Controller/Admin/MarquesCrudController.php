<?php

namespace App\Controller\Admin;

use App\Entity\Marques;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MarquesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marques::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new ('nom');
        yield DateField::new ('date_crea');
        yield TextareaField::new('description');
        yield ImageField::new ('logo')
            ->setBasePath('assets/img/')
            ->setUploadDir("public/assets/img");
    }
}
