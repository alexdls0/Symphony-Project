<?php

namespace App\Form;

use App\Entity\Usuario;
use App\Service\ValidationService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ResetPassFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'mapped' => false,
                    'invalid_message' => 'The password fields must match.',
                    'options' => ['attr' => ['class' => 'text required form-control', 'minlength' => '6', 'maxlength' => '4096']],
                    'required' => true,
                    'empty_data' => '',
                    'trim' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                                ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                                ]),
                        new Regex([
                            'pattern' => ValidationService::regexPassword(),
                            'message' => "Password must contain a number."
                                ])
                    ],
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat Password'],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }

}