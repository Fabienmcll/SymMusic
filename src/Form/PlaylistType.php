<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use App\Repository\MusicRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md',
                ],
            ])
            ->add('music', EntityType::class, [
                'label' => 'Musique',
                'class' => 'App\Entity\Music',
                'query_builder' => function (MusicRepository $r) {
                    return $r->createQueryBuilder('m')
                        ->orderBy('m.title', 'ASC');
                },
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => function() {
                    return ['class' => 'w-1/2 p-2 border rounded-md bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out flex items-center justify-center']; // Amélioration visuelle des options
                },
                'attr' => [
                    'class' => 'flex flex-wrap w-1/2 mx-auto',
                ],
                'data' => $options['data']->getMusic()->toArray(), 
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
