<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new ('email');
        yield ArrayField::new ('role');
        yield TextField::new ('prenom');
        yield TextField::new ('nom');
        yield TextField::new ('adresse');
        yield TextField::new ('ville');
        yield TextField::new ('code_postal');
        yield TextField::new ('pays');
        yield ArrayField::new ('wishlist')->hideOnIndex();

    }
}
