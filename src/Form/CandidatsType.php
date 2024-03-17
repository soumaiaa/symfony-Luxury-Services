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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

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
                'label'=>' ', 
            ])
            ->add('birthplace')
            ->add('currentLocation')
            ->add('description')
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
                
            // ])
            ->add ('user')
            // ->add ('user', UserType::class)
           
            ->add('photo', FileType::class, [
                // 'class' => Media::class,
                // 'choice_label' => 'id',
                'mapped'=>false,
                'label'=>' ',
                'required' => false,
                'attr' => [
                    'id' => 'photo',
                    'size' => '20000000',
                    'accept'=>'.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'photo',
                    'type' => 'file'
                ],
            ])
            ->add('passeport', FileType::class, [
                // 'class' => Media::class,
                // 'choice_label' => 'id',
                'mapped'=>false,
                'label'=>' ',
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '20000000',
                    'accept'=>'.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
                    'type' => 'file'
                ]
            ])
            ->add('cv', FileType::class, [
                // 'class' => Media::class,
                // 'choice_label' => 'id',
                'mapped'=>false,
                'label'=>' ',
                'required' => false,
                'attr' => [
                    'id' => 'cv',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'cv',
                    'type' => 'file'
                ],
              
            ])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'gender',
                'placeholder' => ' ', 
                'label'=>' ',
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'experience',
                'placeholder' => ' ', 
                'label'=>' ',
            ])
            ->add('interestJob', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                'placeholder' => ' ',
                'label'=>' ', 
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
