<?php

namespace App\Form;

use App\Entity\Livraison;
use App\Entity\Depot; // Importez la classe Depot
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Importez le type EntityType

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder           
            ->add('adresselivraison', ChoiceType::class, [
                'choices' => [
                    'Tunis' => 'Tunis',
                    'Sousse' => 'Sousse',
                    'Bizerte' => 'Bizerte',
                    'Ariana' => 'Ariana',
                    'La Marsa' => 'La Marsa',
                    'Ben Arous' => 'Ben Arous',
                ],
                'label' => 'Adresse de livraison',
                'placeholder' => 'Sélectionner une adresse',
                'required' => true,
                'constraints' => [
                    new NotNull(['message' => 'Veuillez sélectionner une adresse de livraison.']),
                ],
            ])
            ->add('datelivraison', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Date de livraison',
                'placeholder' => 'Sélectionner une date',
                'constraints' => [
                    new Callback([$this, 'validateDateLivraison']),
                ],
            ])
            ->add('statuslivraison', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir le statut de la livraison.']),
                ],
            ])
            ->add('latitude', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir la latitude.']),
                ],
            ])
            ->add('longitude', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir la longitude.']),
                ],
            ])
            // Ajoutez le champ iddepot avec le type EntityType pour la relation
            ->add('iddepot', EntityType::class, [
                'class' => Depot::class, // Classe de l'entité cible
                'choice_label' => 'nomdepot', // Choisir le champ à afficher dans le formulaire
                'placeholder' => 'Sélectionner un dépôt',
                'required' => true,
                'constraints' => [
                    new NotNull(['message' => 'Veuillez sélectionner un dépôt.']),
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary', 'onclick' => 'showSuccessAlert();']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }

    public function validateDateLivraison($value, ExecutionContextInterface $context)
    {
        // Récupérer la date actuelle
        $today = new \DateTime();

        // Comparer la date sélectionnée avec la date actuelle
        if ($value < $today) {
            // Si la date sélectionnée est antérieure à la date actuelle, ajouter une violation de contrainte
            $context->buildViolation('La date de livraison ne peut pas être antérieure à la date actuelle.')
                ->addViolation();
        }
    }
}
