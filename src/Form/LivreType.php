<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Livre;
use App\Repository\AuteurRepository;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPages')
            ->add('titre')
            ->add('dateEdition', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('nbExemplaire')
            ->add('prix')
            /*->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'designation',
            ])*/
            ->add('image', FileType::class, [
                'label' => 'Upload Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    dump($categorie->getDesignation());
                    return $categorie->getDesignation();
                },
            ])
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nomEditeur',
            ])
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'query_builder' => function (AuteurRepository $repository) {
                    return $repository->createQueryBuilder('a')
                        ->orderBy('a.nom', 'ASC'); // Order authors by last name
                },
                'choice_label' => function ($auteur) {
                    return $auteur->getPrenom() . ' ' . $auteur->getNom();
                },
                'multiple' => true,  // Allows selecting multiple authors
                'expanded' => false, // Set to true if you want checkboxes instead of a dropdown
                'required' => false, // Make selection optional if needed
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
