<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
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
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre email.']),
                    new Assert\Email([
                        'message' => 'Veuillez saisir une adresse email valide.'
                    ]),
                ],
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Telephone',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre téléphone.']),
                    new Assert\Regex([
                        'pattern' => '/^\d{10}$/',
                        'message' => 'Le numéro de téléphone doit comporter exactement 10 chiffres.',
                    ]),
                ],
                'attr' => [
                    'pattern' => '[0-9]{10}', // Pattern HTML pour les navigateurs non pris en charge
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message.']),
                ],
                'attr' => [
                    'rows' => 4,
                    'maxlength' => 400,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
