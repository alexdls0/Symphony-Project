<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;

use App\Service\MailManager;


final class UsuarioAdmin extends AbstractAdmin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('apodo', TextType::class, [
            'required' => true,
            'label' => 'Nick',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 180,
                    'maxMessage' => 'Exceeded limit, between 1 and 100 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexNickSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: - and _. It cannot end with space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('nombre', TextType::class, [
            'required' => true,
            'label' => 'Name',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers,space and the special characters: -. It cannot end with space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('apellidos', TextType::class, [
            'required' => true,
            'label' => 'Surname',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers,space and the special characters: -. It cannot end with space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('correo', EmailType::class, [
            'disabled' => true,
            'required' => true,
            'label' => 'Email',
            'constraints' => [
                new Length([
                    'max' => 255,
                    'maxMessage' => 'Exceeded limit, between 1 and 255 characters',
                ]),
            ],
        ]);
        
        $formMapper->add('fechapremium',  DateTimePickerType::class, [
            'disabled' => true,
            'label' => 'Premium date',
        ]);
        
        $formMapper->add('fechaalta', DateTimePickerType::class, [
            'disabled' => true,
            'label' => 'Discharge date',
        ]);
        
        $formMapper->add('fechanac', DateType::class, [
            'label' => 'Birthdate',
            'widget' => 'choice',
            'years' => range(1920,date('Y')-14),
        ]);
        
        $formMapper->add('type', ChoiceType::class,array('choices' => array(
            "User" => '0',
            "Admin" => '1'),
            'label' => 'Rol',
            'expanded'=>true,
            'attr' => array('disabled'=>true),
        ));
        
        $formMapper->add('activo', ChoiceType::class,array('choices' => array(
            "No" => '0',
            "Yes" => '1'),
            'label' => 'Active',
            'expanded'=>true,
            'attr' => array('disabled'=>true),
        ));
        
        $formMapper->add('locale', ChoiceType::class, [
            'required' => false,
            'label' => 'Interface language',
            'choices' => [
                    'English' => 'en',
                    'Español' => 'es'
                ]
        ]);
        
        /*$formMapper->add('sendPassword', CheckboxType::class, [
                    'mapped' => false,
                    'label' => 'Send password change email',
                    'required' => false
        ]);*/
        
        $formMapper->add('videolang', ChoiceType::class, [
            'choices'  => [
                  'English' => 'en',
                  'Afar' => 'aa',
                  'Abkhaz' => 'ab',
                  'Avestan' => 'ae',
                  'Afrikaans' => 'af',
                  'Akan' => 'ak',
                  'Amharic' => 'am',
                  'Aragonese' => 'an',
                  'Arabic' => 'ar',
                  'Assamese' => 'as',
                  'Avaric' => 'av',
                  'Aymara' => 'ay',
                  'Azerbaijani' => 'az',
                  'Bashkir' => 'ba',
                  'Belarusian' => 'be',
                  'Bulgarian' => 'bg',
                  'Bihari' => 'bh',
                  'Bislama' => 'bi',
                  'Bambara' => 'bm',
                  'Bengali' => 'bn',
                  'Tibetan Standard, Tibetan, Central' => 'bo',
                  'Breton' => 'br',
                  'Bosnian' => 'bs',
                  'Catalan; Valencian' => 'ca',
                  'Chechen' => 'ce',
                  'Chamorro' => 'ch',
                  'Corsican' => 'co',
                  'Cree' => 'cr',
                  'Czech' => 'cs',
                  'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic' => 'cu',
                  'Chuvash' => 'cv',
                  'Welsh' => 'cy',
                  'Danish' => 'da',
                  'German' => 'de',
                  'Divehi; Dhivehi; Maldivian;' => 'dv',
                  'Dzongkha' => 'dz',
                  'Ewe' => 'ee',
                  'Greek, Modern' => 'el',
                  'Esperanto' => 'eo',
                  'Spanish; Castilian' => 'es',
                  'Estonian' => 'et',
                  'Basque' => 'eu',
                  'Persian' => 'fa',
                  'Fula; Fulah; Pulaar; Pular' => 'ff',
                  'Finnish' => 'fi',
                  'Fijian' => 'fj',
                  'Faroese' => 'fo',
                  'French' => 'fr',
                  'Western Frisian' => 'fy',
                  'Irish' => 'ga',
                  'Scottish Gaelic; Gaelic' => 'gd',
                  'Galician' => 'gl',
                  'GuaranÃ­' => 'gn',
                  'Gujarati' => 'gu',
                  'Manx' => 'gv',
                  'Hausa' => 'ha',
                  'Hebrew (modern)' => 'he',
                  'Hindi' => 'hi',
                  'Hiri Motu' => 'ho',
                  'Croatian' => 'hr',
                  'Haitian; Haitian Creole' => 'ht',
                  'Hungarian' => 'hu',
                  'Armenian' => 'hy',
                  'Herero' => 'hz',
                  'Interlingua' => 'ia',
                  'Indonesian' => 'id',
                  'Interlingue' => 'ie',
                  'Igbo' => 'ig',
                  'Nuosu' => 'ii',
                  'Inupiaq' => 'ik',
                  'Ido' => 'io',
                  'Icelandic' => 'is',
                  'Italian' => 'it',
                  'Inuktitut' => 'iu',
                  'Japanese (ja)' => 'ja',
                  'Javanese (jv)' => 'jv',
                  'Georgian' => 'ka',
                  'Kongo' => 'kg',
                  'Kikuyu, Gikuyu' => 'ki',
                  'Kwanyama, Kuanyama' => 'kj',
                  'Kazakh' => 'kk',
                  'Kalaallisut, Greenlandic' => 'kl',
                  'Khmer' => 'km',
                  'Kannada' => 'kn',
                  'Korean' => 'ko',
                  'Kanuri' => 'kr',
                  'Kashmiri' => 'ks',
                  'Kurdish' => 'ku',
                  'Komi' => 'kv',
                  'Cornish' => 'kw',
                  'Kirghiz, Kyrgyz' => 'ky',
                  'Latin' => 'la',
                  'Luxembourgish, Letzeburgesch' => 'lb',
                  'Luganda' => 'lg',
                  'Limburgish, Limburgan, Limburger' => 'li',
                  'Lingala' => 'ln',
                  'Lao' => 'lo',
                  'Lithuanian' => 'lt',
                  'Luba-Katanga' => 'lu',
                  'Latvian' => 'lv',
                  'Malagasy' => 'mg',
                  'Marshallese' => 'mh',
                  'Maori' => 'mi',
                  'Macedonian' => 'mk',
                  'Malayalam' => 'ml',
                  'Mongolian' => 'mn',
                  'Marathi (Marāṭhī)' => 'mr',
                  'Malay' => 'ms',
                  'Maltese' => 'mt',
                  'Burmese' => 'my',
                  'Nauru' => 'na',
                  'Norwegian Bokmål' => 'nb',
                  'North Ndebele' => 'nd',
                  'Nepali' => 'ne',
                  'Ndonga' => 'ng',
                  'Dutch' => 'nl',
                  'Norwegian Nynorsk' => 'nn',
                  'Norwegian' => 'no',
                  'South Ndebele' => 'nr',
                  'Navajo, Navaho' => 'nv',
                  'Chichewa; Chewa; Nyanja' => 'ny',
                  'Occitan' => 'oc',
                  'Ojibwe, Ojibwa' => 'oj',
                  'Oromo' => 'om',
                  'Oriya' => 'or',
                  'Ossetian, Ossetic' => 'os',
                  'Panjabi, Punjabi' => 'pa',
                  'Pali' => 'pi',
                  'Polish' => 'pl',
                  'Pashto, Pushto' => 'ps',
                  'Portuguese' => 'pt',
                  'Quechua' => 'qu',
                  'Romansh' => 'rm',
                  'Kirundi' => 'rn',
                  'Romanian, Moldavian, Moldovan' => 'ro',
                  'Russian' => 'ru',
                  'Kinyarwanda' => 'rw',
                  'Sanskrit (Saṁskṛta)' => 'sa',
                  'Sardinian' => 'sc',
                  'Sindhi' => 'sd',
                  'Northern Sami' => 'se',
                  'Sango' => 'sg',
                  'Sinhala, Sinhalese' => 'si',
                  'Slovak' => 'sk',
                  'Slovene' => 'sl',
                  'Samoan' => 'sm',
                  'Shona' => 'sn',
                  'Somali' => 'so',
                  'Albanian' => 'sq',
                  'Serbian' => 'sr',
                  'Swati' => 'ss',
                  'Southern Sotho' => 'st',
                  'Sundanese' => 'su',
                  'Swedish' => 'sv',
                  'Swahili' => 'sw',
                  'Tamil' => 'ta',
                  'Telugu' => 'te',
                  'Tajik' => 'tg',
                  'Thai' => 'th',
                  'Tigrinya' => 'ti',
                  'Turkmen' => 'tk',
                  'Tagalog' => 'tl',
                  'Tswana' => 'tn',
                  'Tonga (Tonga Islands)' => 'to',
                  'Turkish' => 'tr',
                  'Tsonga' => 'ts',
                  'Tatar' => 'tt',
                  'Twi' => 'tw',
                  'Tahitian' => 'ty',
                  'Uighur, Uyghur' => 'ug',
                  'Ukrainian' => 'uk',
                  'Urdu' => 'ur',
                  'Uzbek' => 'uz',
                  'Venda' => 've',
                  'Vietnamese' => 'vi',
                  'Volapük' => 'vo',
                  'Walloon' => 'wa',
                  'Wolof' => 'wo',
                  'Xhosa' => 'xh',
                  'Yiddish' => 'yi',
                  'Yoruba' => 'yo',
                  'Zhuang, Chuang' => 'za',
                  'Chinese' => 'zh',
                  'Zulu' => 'zu',
            ],
            'label' => 'Lang Code',
        ]);
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('activo', null, ['label' => 'Active']);
        $datagridMapper->add('type', 'doctrine_orm_number', ['label' => 'Admin']);
        $datagridMapper->add('apodo', null, ['label' => 'Nick']);
        $datagridMapper->add('correo', null, ['label' => 'Email']);
        $datagridMapper->add('nombre', null, ['label' => 'Name']);
        $datagridMapper->add('apellidos', null, ['label' => 'Surname']);
        $datagridMapper->add('videolang', null, ['label' => 'Lang Code']);
        $datagridMapper->add('fechaalta', 'doctrine_orm_date', ['label' => 'Discharge date'], null, ['years' => range(2019,date('Y'))]);
        $datagridMapper->add('fechapremium', 'doctrine_orm_date', ['label' => 'Premium date'], null, ['years' => range(2018,date('Y'))]);
        $datagridMapper->add('fechanac', 'doctrine_orm_date', ['label' => 'Birthdate'], null, ['years' => range(1920,date('Y')-13)]);
        $datagridMapper->add('locale',null, ['label' => 'UI Lang'], ChoiceType::class, array('choices' => array('English' => 'en', 'Español' => 'es')));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->add('activo', null, ['label' => 'Active']);
        $listMapper->add('type', null, ['label' => 'Admin']);
        $listMapper->add('apodo', null, ['label' => 'Nick']);
        $listMapper->add('correo', null, ['label' => 'Email']);
        $listMapper->add('nombre', null, ['label' => 'Name']);
        $listMapper->add('apellidos', null, ['label' => 'Surname']);
        $listMapper->add('locale', null, ['label' => 'UI Lang']);
        $listMapper->add('videolang', null, ['label' => 'Lang Code']);
        $listMapper->add('fechaalta', null, ['label' => 'Discharge']);
        $listMapper->add('fechapremium', null, ['label' => 'Premium']);
        $listMapper->add('fechanac', null, ['label' => 'Birthdate']);
    }
    

}