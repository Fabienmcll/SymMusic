<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label_attr' => ['class' => 'mr-3 flex justify-center'], 
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ])
            ->add('description', null, [
                'label_attr' => ['class' => 'mr-3 flex justify-center'], 
                'attr' => [
                    'class' => 'border p-2 mb-4 w-1/2 mx-auto rounded-md', 
                ],
            ]);
    }
        

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
