<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class , [
                'label' => 'Pseudo',
                'attr' => ['class' => 'form-input'],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Ce champ doit contenir entre 2 et 63 caractères',
                        'max' => 63,
                    ]),
                ]])
            ->add('first_name', TextType::class , [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-input'],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Ce champ doit contenir entre 2 et 63 caractères',
                        'max' => 63,
                    ]),
                ]])
            ->add('last_name', TextType::class , [
                'label' => 'Nom',
                'attr' => ['class' => 'form-input'],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Ce champ doit contenir entre 2 et 63 caractères',
                        'max' => 63,
                    ]),
                ]])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-input'],
                'constraints' => [
                    new Length([
                        'minMessage' => 'Ce champ ne peut pas excéder 180 caractères',
                        'max' => 180,
                    ]),
            ]]) 
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-input'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 255,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
