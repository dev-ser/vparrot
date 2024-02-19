<?php
namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ\-\' ]+$/',
                        'message' => 'Veuillez saisir un nom valide.',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre prénom.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ\-\' ]+$/',
                        'message' => 'Veuillez saisir un prénom valide.',
                    ]),
                ],
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Votre message',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message.']),
                    new Assert\Regex([
                        // 'pattern' => '/^[a-zA-ZÀ-ÿ\-\' .]+$/',
                        'pattern' => '/^[a-zA-ZÀ-àéèê\s\'\,\.\-]+$/u',
                        'message' => 'Veuillez saisir un message valide.',
                    ]),
                ],
                'attr' => [
                    'rows' => 4,
                    'maxlength' => 500,
                ],
            ])
            
            ->add('note', ChoiceType::class, [
                'label' => 'Votre note',
                'choices' => [
                    '1 étoile' => 1,
                    '2 étoiles' => 2,
                    '3 étoiles' => 3,
                    '4 étoiles' => 4,
                    '5 étoiles' => 5,
                ],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner une note.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}