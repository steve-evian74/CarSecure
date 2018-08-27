<?php

// /src/Form/UserType.php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('adresse', TextType::class)
                ->add('codePostal', TextType::class)
                ->add('ville', TextType::class)
                ->add('telFixe', TextType::class)
                ->add('telPortable', TextType::class)
                ->add('typeRoles', ChoiceType::class, array(
                    'expanded' => true,
                    'choices' => array(
                        'particulier' => 1,
                        'garagiste' => 2,
                        'auteur' => 3,
                    ),
                ))
                ->add('numeroSiret')
                ->add('description')
                ->add('nomEntreprise')
                ->add('username', TextType::class)
                ->add('email', EmailType::class)
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('conditionGeneral')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

}
