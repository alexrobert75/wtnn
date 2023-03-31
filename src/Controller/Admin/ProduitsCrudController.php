<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Products management");
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new ('nom');
        yield AssociationField::new ('marque');
        yield TextField::new ('categorie');
        yield TextareaField::new ('description');
        yield NumberField::new ('prix');
        // yield TextField::new ('photo_url')->hideOnIndex();
        yield ImageField::new ('photo_url')
            ->setBasePath('assets/img/')
            ->setUploadDir("public/assets/img");
        yield TextField::new ('couleur');
        yield TextField::new ('ref');
        yield SlugField::new ('slug')->setTargetFieldName('nom')->hideOnIndex();

    }

}