<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
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
                'constraints' =>[
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
            ->add('prenom', TextType::class,[
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label mt-2'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 3,
                    'maxlength' => 50,
                    'placeholder' => 'Entrez votre prénom'
                ],
                'constraints' =>[
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le prénom doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Assert\NotBlank([
                        'message' => 'Le prénom est obligatoire'
                    ])
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label mt-2'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 3,
                    'maxlength' => 50,
                    'placeholder' => 'Entrez votre email'
                ],
                'constraints' =>[
                    new Assert\Email([
                        'message' => 'L\'email n\'est pas valide'
                    ]),
                    new Assert\NotBlank([
                        'message' => 'L\'email est obligatoire'
                    ])
                ]
            ])
            ->add('telephone', TextType::class,[
                'label' => 'Téléphone',
                'label_attr' => [
                    'class' => 'form-label mt-2'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 3,
                    'maxlength' => 50,
                    'placeholder' => 'Entrez votre téléphone'
                ],
                'constraints' =>[
                    new Assert\Regex([
                        'pattern' => '/^0[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Le numéro de téléphone n\'est pas valide'
                    ]),
                    new Assert\NotBlank([
                        'message' => 'Le téléphone est obligatoire'
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
            'data_class' => Contact::class,
        ]);
    }
}
