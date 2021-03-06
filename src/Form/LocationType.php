<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('prix')*/
            ->add('debut_location', DateType::class,array(
                'format'=> 'dd-MM-yyyy',
                'data'=> new \DateTime("now")
            ) )
            ->add('fin_location', DateType::class,array(
                'format'=> 'dd-MM-yyyy',
                'data'=> new \DateTime("now")
            ) )
            /*->add('status')*/
            ->add('Voiture', EntityType::class, [
                'class'=> Voiture::class,
                'choice_label'=> 'marque',
                'multiple'=> false,
            ])
            /*->add('Client', EntityType::class, [
                'class'=>Client::class,
                'choice_label'=> 'nom',
                'multiple'=>false,
            ])*/
        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
