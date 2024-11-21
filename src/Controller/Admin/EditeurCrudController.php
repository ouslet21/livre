<?php

namespace App\Controller\Admin;

use App\Entity\Editeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EditeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Editeur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache l'ID dans le formulaire
            TextField::new('nomEditeur', 'Nom de l\'Éditeur'), // Champ pour le nom de l'éditeur
            TextField::new('pays', 'Pays'), // Champ pour le pays
            TextField::new('adresse', 'Adresse'), // Champ pour l'adresse
            IntegerField::new('telephone', 'Téléphone'), // Champ pour le numéro de téléphone
            AssociationField::new('livres', 'Livres publiés')->onlyOnDetail(), // Association pour les livres, visible seulement dans les détails
            // Dans EditeurCrudController
            /*AssociationField::new('livres', 'Livres publiés')
                ->setFormTypeOption('choice_label', function($livre) {
                    return $livre->getTitre(); // Affiche le titre du livre dans la liste des livres
                }),*/

        ];
    }
}
