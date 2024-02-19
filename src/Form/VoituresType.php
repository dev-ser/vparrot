<?php

namespace App\Form;

use App\Entity\Voitures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type; 
use Symfony\Component\Validator\Constraints\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class VoituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('marque', null, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide.',
                ]),
                new Regex([
                    'pattern' => '/^[a-zA-Z]+$/',
                    'message' => 'Merci de saisir uniquement des lettres.',
                ]),
                new Regex([
                    'pattern' => '/\d/',
                    'match' => false, // Ne doit pas contenir des chiffres
                    'message' => 'Les chiffres ne sont pas autorisés dans ce champ.',
                ]),
            ],
        ])
        
        ->add('model', null, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide.',
                ]),
                new Regex([
                    'pattern' => '/^[a-zA-Z0-9]+$/',
                    'message' => 'Merci de saisir uniquement des lettres et des chiffres.',
                ]),
            ],
        ])        
        
        ->add('annee', IntegerType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide.',
                ]),
                new Regex([
                    'pattern' => '/^\d+$/',
                    'message' => 'Merci de saisir des chiffres uniquement.',
                ]),
                new Length([
                    'min' => 4,
                    'max' => 4,
                    'minMessage' => 'L\'année doit contenir exactement 4 chiffres.',
                    'maxMessage' => 'L\'année doit contenir exactement 4 chiffres.',
                ]),
            ],
        ])
            
            ->add('km', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Merci de saisir des chiffres uniquement.',
                    ]),
                    new Type([
                        'type' => 'integer',
                        'message' => 'La valeur doit être un nombre entier.',
                    ]),
                ],
            ])
            ->add('energie', ChoiceType::class, [
                'choices' => [
                    'Electrique' => 'Electrique',
                    'Essence' => 'Essence',
                    'Diesel' => 'Diesel',
                ],
                'placeholder' => 'Choisissez le type d\'énergie.', 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                ],
            ])
            
            ->add('vitesse', ChoiceType::class, [
                'choices' => [
                    'Automatique' => 'Automatique',
                    'Manuelle' => 'Manuelle',
                ],
                'placeholder' => 'Choisissez le type de vitesse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car1', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])
            
            ->add('car2', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car3', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car4', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ], 
            ])
            ->add('car5', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('vitesse', ChoiceType::class, [
                'choices' => [
                    'Automatique' => 'Automatique',
                    'Manuelle' => 'Manuelle',
                ],
                'placeholder' => 'Choisissez le type de vitesse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car1', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])
            
            ->add('car2', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car3', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])

            ->add('car4', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ], 
            ])
            ->add('car5', FileType::class, [
                'label' => 'Image',
                'multiple' => false, 
                'required' => false,
                'mapped' => false, 
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux. La taille maximale autorisée est 1 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image n\'est pas valide. Les formats autorisés sont : JPEG, PNG et GIF.',
                    ]),
                ],
            ])
            ->add('prix', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Merci de saisir des chiffres uniquement.',
                    ]),
                ],
            ]);
            }

            
                public function configureOptions(OptionsResolver $resolver): void
                {
                    $resolver->setDefaults([
                        'data_class' => Voitures::class,
                    ]);
                }
            }