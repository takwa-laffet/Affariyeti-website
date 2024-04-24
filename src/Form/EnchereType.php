<?php

namespace App\Form;

use App\Entity\Enchere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class EnchereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une date de début.']),
                ],
            ])
            ->add('heured', DateTimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une Heure de début.']),
                ],
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une Heure de début.']),
                    new File([
                        'mimeTypes' => ['image/*'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (png, jpeg, jpg).',
                    ]),
                ],
            ])
            ->add('heuref', DateTimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une Heure de fin.']),
                ],
            ])
            ->add('montantInitial', null, [
                'label' => 'Montant initial',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un Montant initial > 0.']),
                ],
            ])
            ->add('nomEnchere', null, [
                'label' => 'Nom de l\'enchère',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir Nom de l\'enchere.']),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (png, jpeg, jpg).',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enchere::class,
        ]);
    }
}
