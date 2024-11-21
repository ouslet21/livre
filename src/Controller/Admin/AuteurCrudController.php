<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auteur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache l'ID dans le formulaire
            TextField::new('nom', 'Nom'), // Champ pour le nom de l'auteur
            TextField::new('prenom', 'Prénom'), // Champ pour le prénom de l'auteur
            TextEditorField::new('biographie', 'Biographie'), // Champ pour la biographie de l'auteur
            AssociationField::new('livres', 'Livres associés')->setFormTypeOption('by_reference', false), // Association pour les livres, permet de choisir les livres associés
            /*AssociationField::new('livres', 'Livres associés')
                ->setFormTypeOption('choice_label', function($livre) {
                    return $livre->getTitre(); // Utilise un champ textuel (titre) pour afficher les livres
                }),*/


        ];
    }

}
