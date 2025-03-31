<?php

namespace App\Form;

use App\Entity\Games;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GamesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('RoundCount', ChoiceType::class, [
                'label' => 'Indiquez le nombre de rounds', // Nouveau label affiché dans le formulaire
                'choices' => array_combine(range(1, 10), range(1, 10)), // Génère les options de 1 à 10
        
            ])
            //->add('GameStatut')
            ->add('CreatedBy', EntityType::class, [
                'class' => User::class,
                'label' => 'Crée par:',  // On se réfère à l'entité User
                'choice_label' => 'pseudo', // On utilise l'email comme étiquette pour les choix dans le formulaire
                'disabled' => true, // Le champ est en lecture seule, donc l'utilisateur ne peut pas le modifier
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Games::class,
        ]);
    }
}
