<?php

namespace App\Controller\Admin;

use App\Entity\TailleStock;
use phpDocumentor\Reflection\Types\Integer;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TailleStockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TailleStock::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new ('id_produit')
        ->setFormTypeOptions(['by_reference' => false,]);
        yield IntegerField::new('taille');
        yield IntegerField::new('stock');  


    }
}
