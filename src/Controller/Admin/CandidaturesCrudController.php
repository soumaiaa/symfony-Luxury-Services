<?php

namespace App\Controller\Admin;

use App\Entity\Candidatures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidaturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidatures::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
        
            TextField::new('date'),
            AssociationField::new('offre'),
            AssociationField::new('candidat'),
          
        ];
    }
    
}
