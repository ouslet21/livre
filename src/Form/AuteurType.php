<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('biographie')
            /*->add('livres', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'id',
                'multiple' => true,
            ]);*/
            ->add('livres', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'titre', // Utilisez un champ textuel comme 'titre' plutôt que 'id'
                'multiple' => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
