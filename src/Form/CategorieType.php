<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Licencie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-2'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 3,
                    'maxlength' => 50,
                    'placeholder' => 'Entrez votre nom'
                ],
                'constraints'=>[
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Assert\NotBlank([
                        'message' => 'Le nom est obligatoire'
                    ])
                ]
            ])
            ->add('code_raccourci', TextType::class,[
                'label' => 'Code raccourci',
                'label_attr' => [
                    'class' => 'form-label mt-2'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 1,
                    'maxlength' => 5,
                    'placeholder' => 'Entrez le code raccourci'
                ],
                'constraints'=>[
                    new Assert\Length([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Le code raccourci doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le code raccourci doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Assert\NotBlank([
                        'message' => 'Le code raccourci est obligatoire'
                    ])
                ]
            ])
            -> add('submit', SubmitType::class,[
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'btn btn-primary mt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
