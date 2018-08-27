<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VoitureType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('immatriculation')
                ->add('marque')
                ->add('modele')
                ->add('finition')
                ->add('dateAchat')
                ->add('energie')
                ->add('cvFiscale')
                ->add('cvDin')
                ->add('vente')
                ->add('kilometre')
                ->add('description')
                ->add('fkUser',EntityType::class, array(
                'class'=> User::class,
                'choice_label'=> 'username'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }

}
