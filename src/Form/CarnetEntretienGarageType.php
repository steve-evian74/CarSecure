<?php

namespace App\Form;

use App\Entity\CarnetEntretien;
use App\Entity\FicheVoiture;
use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

    class CarnetEntretienGarageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
               
                ->add('kilometre')
                ->add('commentaireIntervention')
                ->add('fkIntervention', EntityType::class, array(
                    'class' => Intervention::class,
                    'choice_label' => 'libelle'
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => CarnetEntretien::class,
        ]);
    }

}
