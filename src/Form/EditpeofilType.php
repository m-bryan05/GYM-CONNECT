<?php

namespace App\Form;

use App\Entity\Saledesport;
use App\Entity\User;
use App\Repository\SaledeSportRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditpeofilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 4])],
            ])
            ->add('tel', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un num tel',
                    ]),
                    new Length(['min' => 8])],
            ])
            ->add('saledesport',EntityType::class ,[
                'class'=>Saledesport ::class,
                'choice_label'=> 'name',
                'placeholder' => 'please choose a reservation',
                'query_builder'=>function(SaledeSportRepository $catrepo){
                    return $catrepo->createQueryBuilder('c')

                        ;

                }
            ])
            ->add('email', EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un e-mail',
                    ]),
                ],
                'required' => true,
                'attr' => ['class' =>'form-control'],
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
