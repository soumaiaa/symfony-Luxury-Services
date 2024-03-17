<?php

namespace App\Controller\Admin;

use App\Entity\Offres;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OffresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offres::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('startingDate'),
            TextField::new('position'),
            TextField::new('location'),
            IdField::new('salaire'),
            TextField::new('statut'),
            TextField::new('dateCloture'),
            TextField::new('ref'),
            TextField::new('description'),          
            AssociationField::new('categorie'),
            AssociationField::new('typecontract'),
            AssociationField::new('client'),
        ];
    }
    
}
