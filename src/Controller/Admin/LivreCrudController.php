<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache le champ ID dans le formulaire
            TextField::new('titre', 'Titre'), // Champ pour le titre
            IntegerField::new('nbPages', 'Nombre de pages'), // Champ pour le nombre de pages
            DateField::new('dateEdition', 'Date d\'édition'), // Champ pour la date d'édition
            IntegerField::new('nbExemplaire', 'Nombre d\'exemplaires'), // Champ pour le nombre d'exemplaires
            MoneyField::new('prix', 'Prix')->setCurrency('EUR'), // Champ pour le prix avec devise EUR
            //AssociationField::new('categorie', 'Catégorie'), // Association pour la catégorie
            AssociationField::new('categorie', 'Catégorie')
                ->setFormTypeOption('choice_label', 'designation'),

            AssociationField::new('auteur', 'Auteurs')->setFormTypeOption('by_reference', false), // Association multiple pour les auteurs
            AssociationField::new('editeur', 'Éditeur'), // Association pour l'éditeur
             ImageField::new('image', 'Image')
                 ->setBasePath('uploads/images') // Path for displaying images
                 ->setUploadDir('public/uploads/images') // Directory for uploaded images
                 ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]') // File naming pattern
                 ->setRequired(false), // Optional image field
        ];
    }

}
