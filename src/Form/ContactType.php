<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName',TextType::class, [
            'label' => 'Votre prénom',
            'constraints' => [
                new Length([
                    'min' => 2,
                    'minMessage' => 'Ce champ doit contenir entre 2 et 255 caractères',
                    'max' => 255,
                ]),
            ]])
        ->add('email',EmailType::class, [
            'label' => 'Votre e-mail',
            'constraints' => [
            new Length([
                'minMessage' => 'Ce champ ne peut pas excéder 180 caractères',
                'max' => 180,
            ]),
        ]])
        ->add('message', TextareaType::class, [
            'attr' => ['rows' => 10],
            'constraints' => [
                new Length([
                    'minMessage' => 'Votre message ne peut pas excéder 4000 caractères',
                    'max' => 4000,
                ]),
                new NotBlank([
                    'message' => 'Le champ message ne peut pas être vide',
                ])
        ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
