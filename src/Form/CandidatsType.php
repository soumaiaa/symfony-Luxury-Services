<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\Categorie;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\Media;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('country')
            ->add('nationalite')
            ->add('birthdate', null, [
                'widget' => 'single_text',
            ])
            ->add('birthplace')
            ->add('currentLocation')
            ->add('description')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('photo', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'id',
            ])
            ->add('passeport', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'id',
            ])
            ->add('cv', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'id',
            ])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'id',
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'id',
            ])
            ->add('interestJob', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidats::class,
        ]);
    }
}
