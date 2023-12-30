<?php

namespace App\Form;

use App\Entity\Music;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MusicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('artist', TextType::class, [
                'label' => 'Artiste',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('album', TextType::class, [
                'label' => 'Album',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('release_year', TextType::class, [
                'label' => 'Année de sortie',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('genre', TextType::class, [
                'label' => 'Genre',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('duration', TextType::class, [
                'label' => 'Durée',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md',
                ],
            ])
            ->add('song_url', TextType::class, [
                'label' => 'URL de la chanson',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'bg-blue-500 text-white p-2 rounded-md',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Music::class,
        ]);
    }
}
