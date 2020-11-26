<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array ('label' => 'Nom :'))
            ->add('datedebut', DateType::class, array('label' => 'Date de la sortie : '))
            ->add('duree')
            ->add('datecloture', DateType::class, array('label' => 'Date de cloture :'))
            ->add('nbinscriptionsmax', IntegerType::class, array('label' => "Nombre d'inscriptions max :" ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
