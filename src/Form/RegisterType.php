<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, array('label'=>'Pseudo :'))
            ->add('nom',TextType::class, array('label'=>'Nom :'))
            ->add('prenom',TextType::class, array('label'=>'Prénom :'))
            ->add('telephone', IntegerType::class, array('label'=>'Téléphone :'))
            ->add('email', EmailType::class, array('label'=>'Email :'))
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmer le mot de passe :'],])
            ->add('admin', CheckboxType::class ,array('label'=>'Admin :'))
            ->add('actif', CheckboxType::class ,array('label'=>'Actif :'))
            ->add('campus')
           // ->add('picture', FileType::class, array('label' =>'Photo de profil :',
             //   'data_class' => null,
               // 'required' => false))

        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }

}
