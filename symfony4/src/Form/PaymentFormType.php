<?php

namespace App\Form;

use App\Entity\Pago;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;


use Symfony\Component\Validator\Constraints\CardScheme;
use App\Service\ValidationService;

class PaymentFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        //Unmapped
        $builder
            ->add('plan', ChoiceType::class, [
                'label' => 'Plan',
                'mapped' => false,
                'required' => true,
                'expanded' => true,
                'choices' => [
                    '1 Month' => '1',
                    '3 Months' => '3',
                    '6 Months'   => '6',
                    '12 Months' => '12',
                ],
                'attr' => ['class' => 'js-activePlan'],
                
            ])
            ->add('correo', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'mapped' => false,
                'trim' => true,
                'empty_data' => '',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Exceeded limit, between 1 and 255 characters',
                    ]),
                ],
                'attr' => ['class' => 'js-payerEmail text email required form-control'],
            ]);
        
        $builder->add('expiracion', DateType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Expiry (YYYY-MM)',
                'widget' => 'single_text',
                'format' => 'y/M',
                'constraints' => [
                    new NotBlank(),
                    new GreaterThanOrEqual([
                            'value' => date('Y-m'),
                            'message' => 'Your card seems to have expired, check the date (Y-m), or try another card'
                        ])
                ],
                'attr' => ['class' => 'date required form-control'],
            ]);
            
        //Mapped
        $builder->add('nombretitular', TextType::class, [
            'required' => true,
            'label' => 'Owner name',
            'trim' => true,
            'empty_data' => '',
            'constraints' => [
                new NotBlank(),
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
            'attr' => ['class' => 'js-payerName text required form-control']
        ]);
        
        $builder->add('apellidotitular', TextType::class, [
            'required' => true,
            'label' => 'Owner surname',
            'trim' => true,
            'empty_data' => '',
            'constraints' => [
                new NotBlank(),
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
            'attr' => ['class' => 'js-payerSurname text required form-control']
        ]);
        
        $builder->add('numerotarjeta', TextType::class, [
            'required' => true,
            'label' => 'Card number',
            'trim' => false,
            'empty_data' =>'',
            'constraints' => [
                new NotBlank(),
                new Regex([
                    'pattern' => ValidationService::regexNumbersOnly(),
                    'message' => 'Must only contain digits',
                ]),
                new CardScheme([
                        'schemes' => ['AMEX', 'CHINA_UNIONPAY', 'MAESTRO', 'MASTERCARD', 'VISA'],
                        'message' => 'Card format invalid'
                    ]),
                new Length([
                    'min' => 13,
                    'minMessage' => 'A credit card must have at least 13 digits',
                    'max' => 18,
                    'maxMessage' => 'Exceeded limit, a credit card has between 13 and 18 digits',
                ]),
            ],
            'attr' => ['class' => 'digits required form-control', 'maxlength' => '18', 'minlength' => '13']
        ]);
        
        $builder->add('cvv', TextType::class, [
            'required' => true,
            'label' => 'Card Verification Value',
            'trim' => false,
            'empty_data' => '',
            'constraints' => [
                new NotBlank(),
                new Regex([
                    'pattern' => ValidationService::regexNumbersOnly(),
                    'message' => 'Must only contain digits',
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Must contain at least 3 digits',
                    'max' => 4,
                    'maxMessage' => 'Exceeded limit, 3-4 digits',
                ]),
            ],
            'attr' => ['class' => 'digits required form-control', 'maxlength' => '4', 'minlength' => '3']
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }

}
