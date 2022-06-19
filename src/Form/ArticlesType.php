<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class , [
                'label' => 'Titre de l\'article',
                'attr' => ['class' => 'new-article_input'],
                'constraints' => [
                    new Length([
                        'minMessage' => 'Ce champ ne peut pas excéder 255 caractères',
                        'max' => 255,
                    ]),
            ]])
            ->add('content',TextareaType::class, [
                'label' => 'Contenu de l\'article',
                'attr' => ['rows' => 20, 'class' => 'new-article_input'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le contenu ne peut pas être vide',
                    ]),
            ]]) 
            
            //->add('published_date')
           //->add('user')
           
           //Access to the property name of the Categories Class
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'label' => 'Catégorie(s)',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true //Multiple choices
            ])

            //Upload image
            ->add('image', FileType::class, [
                'label' => 'Insérer une image d\'en tête (format jpg ou jpeg)',
                'attr' => ['class' => 'new-article_input'],
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez fournir une extension de fichier valide ',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
