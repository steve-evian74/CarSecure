<?php

namespace App\Form;

use App\Entity\CarnetEntretien;
use App\Entity\User;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarnetEntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateIntervention')
            ->add('kilometre')
            ->add('commentaireIntervention')
            ->add('fkVoiture', EntityType::class, array(
                    'class' => Voiture::class,
                    'choice_label' => 'immatriculation'
                ))
            ->add('fkUserGarage', EntityType::class, array(
                    'class' => User::class,
                    'choice_label' => 'username'
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarnetEntretien::class,
        ]);
    }
}
