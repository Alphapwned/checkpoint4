<?php

namespace App\Form;

use App\Entity\Portfolio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PortfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom du projet',
                    'class' => 'project_create_name'
                )))

            ->add('image', TextType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Image',
                    'class' => 'project_create_image'
                )))

            ->add('summary', TextareaType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Résumé',
                    'class' => 'project_create_summary'
                )))

            ->add('content', TextareaType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Contenu de l\'article',
                    'class' => 'project_create_content'
                )))

            ->add('duration', IntegerType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Durée du projet',
                    'class' => 'project_create_duration'
                )))

            ->add('langage', TextType::class, array (
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Langage utilisé',
                    'class' => 'project_create_langage'
                )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
