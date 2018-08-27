<?php

namespace App\Form;

use App\Entity\UploadImage;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UploadImageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('image', FileType::class, array('label' => 'Brochure (PDF file)'))
                ->add('fkVoitureUpload',  EntityType::class, array(
                    'class' => Voiture::class,
                    'choice_label' => 'immatriculation'
                ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => UploadImage::class,
        ));
    }

}
