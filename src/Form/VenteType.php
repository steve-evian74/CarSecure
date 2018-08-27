<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('marque')
                ->add('modele')
                ->add('finition')
                ->add('dateAchat')
                ->add('energie')
                ->add('cvFiscale')
                ->add('cvDin')
                ->add('kilometre')
                ->add('description')
        //->add('fkUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }

}
