<?php
namespace App\Form;

use App\Entity\Horaires;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class HorairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jour', TextType::class, [
                'required' => false,
            ])
            ->add('debutMatin', TimeType::class, [
                'required' => false,
            ])
            ->add('finMatin', TimeType::class, [
                'required' => false,
            ])
            ->add('debutApresMidi', TimeType::class, [
                'required' => false,
            ])
            ->add('finApresMidi', TimeType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horaires::class,
        ]);
    }
}
