<?php

namespace App\Controller\Admin;

use App\Entity\Candidats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidats::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('address'),
            TextField::new('country'),
            TextField::new('nationalite'),
            TextField::new('birthDate'),
            TextField::new('birthPlace'),
            TextField::new('currentLocation'),
            TextField::new('description'),
            // EntityType::new('relationManyToOne', 'Entité ManyToOne')
            // ->setClass(VotreClasseManyToOne::class)
            // ->setRequired(true),
            AssociationField::new('gender'),
            AssociationField::new('photo'),
            AssociationField::new('passeport'),
            AssociationField::new('cv'),
            AssociationField::new('interestJob'),
            AssociationField::new('experience'),
            AssociationField::new('user'),
        ];
    }
    
}
