<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;
use Sonata\Form\Type\DatePickerType;
use Sonata\CoreBundle\Validator\ErrorElement;

final class VideoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('titulo', TextType::class, [
            'required' => true,
            'trim' => false,
            'label' => 'Title',
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexNameVideoSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: - and _. It cannot end with space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('descripcion', TextareaType::class, [
            'required' => false,
            'label' => 'Description',
        ]);
        
        $formMapper->add('director', ModelListType::class, [
            'required' => false,
            'label' => 'Director']
        );

        $formMapper->add('productor', ModelListType::class, [
            'required' => false,
            'label' => 'Producer']
        );
        
        $formMapper->add('edad', IntegerType::class, [
            'required' => true,
            'trim' => false,
            'label' => 'Minimun age',
            'constraints' => [
                new Length([
                    'max' => 2,
                    'maxMessage' => 'Exceeded limit, between 1 and 2 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexClasificationAge(),
                    'message' => 'The season number must be an integer between 0 and 18',
                ]),
            ],
        ]);
        
        $formMapper->add('src', UrlType::class, [
            'label' => 'Source',
            'required' => true,
        ]);
        
        $formMapper->add('thumbsrc', UrlType::class, [
            'label' => 'Thumb Source',
            'required' => false,
        ]);
        
        $formMapper->add('premium', ChoiceType::class, [
            'label' => 'Premium',
            'required' => true,
            'choices'  => [
                'No' => '0',
                'Yes' => '1'
            ],
        ]);
        
        $formMapper->add('tipo', ChoiceType::class, [
            'label' => 'Type',
            'required' => true,
            'choices'  => [
                'Movie' => '0',
                'Show Episode' => '1'
            ],
        ]);
        
        $formMapper->add('grupo', ModelListType::class, [
            'required' => false,
            'label' => 'Group']
        );
        
        $formMapper->add('temporada', ModelListType::class, [
            'required' => false,
            'label' => 'Show seasons']
        );
        
        $formMapper->add('categorias', ModelAutocompleteType::class, [
            'required' => true,
            'multiple' => true,
            'property' => 'titulo',
            'label' => 'Categories',
            'minimum_input_length' => 0,
            ]
        );
        
        $countries = array (
                'US' => 'United States',
            	'AF' => 'Afghanistan',
            	'AX' => 'Aland Islands',
            	'AL' => 'Albania',
            	'DZ' => 'Algeria',
            	'AS' => 'American Samoa',
            	'AD' => 'Andorra',
            	'AO' => 'Angola',
            	'AI' => 'Anguilla',
            	'AQ' => 'Antarctica',
            	'AG' => 'Antigua And Barbuda',
            	'AR' => 'Argentina',
            	'AM' => 'Armenia',
            	'AW' => 'Aruba',
            	'AU' => 'Australia',
            	'AT' => 'Austria',
            	'AZ' => 'Azerbaijan',
            	'BS' => 'Bahamas',
            	'BH' => 'Bahrain',
            	'BD' => 'Bangladesh',
            	'BB' => 'Barbados',
            	'BY' => 'Belarus',
            	'BE' => 'Belgium',
            	'BZ' => 'Belize',
            	'BJ' => 'Benin',
            	'BM' => 'Bermuda',
            	'BT' => 'Bhutan',
            	'BO' => 'Bolivia',
            	'BA' => 'Bosnia And Herzegovina',
            	'BW' => 'Botswana',
            	'BV' => 'Bouvet Island',
            	'BR' => 'Brazil',
            	'IO' => 'British Indian Ocean Territory',
            	'BN' => 'Brunei Darussalam',
            	'BG' => 'Bulgaria',
            	'BF' => 'Burkina Faso',
            	'BI' => 'Burundi',
            	'KH' => 'Cambodia',
            	'CM' => 'Cameroon',
            	'CA' => 'Canada',
            	'CV' => 'Cape Verde',
            	'KY' => 'Cayman Islands',
            	'CF' => 'Central African Republic',
            	'TD' => 'Chad',
            	'CL' => 'Chile',
            	'CN' => 'China',
            	'CX' => 'Christmas Island',
            	'CC' => 'Cocos (Keeling) Islands',
            	'CO' => 'Colombia',
            	'KM' => 'Comoros',
            	'CG' => 'Congo',
            	'CD' => 'Congo, Democratic Republic',
            	'CK' => 'Cook Islands',
            	'CR' => 'Costa Rica',
            	'CI' => 'Cote D\'Ivoire',
            	'HR' => 'Croatia',
            	'CU' => 'Cuba',
            	'CY' => 'Cyprus',
            	'CZ' => 'Czech Republic',
            	'DK' => 'Denmark',
            	'DJ' => 'Djibouti',
            	'DM' => 'Dominica',
            	'DO' => 'Dominican Republic',
            	'EC' => 'Ecuador',
            	'EG' => 'Egypt',
            	'SV' => 'El Salvador',
            	'GQ' => 'Equatorial Guinea',
            	'ER' => 'Eritrea',
            	'EE' => 'Estonia',
            	'ET' => 'Ethiopia',
            	'FK' => 'Falkland Islands (Malvinas)',
            	'FO' => 'Faroe Islands',
            	'FJ' => 'Fiji',
            	'FI' => 'Finland',
            	'FR' => 'France',
            	'GF' => 'French Guiana',
            	'PF' => 'French Polynesia',
            	'TF' => 'French Southern Territories',
            	'GA' => 'Gabon',
            	'GM' => 'Gambia',
            	'GE' => 'Georgia',
            	'DE' => 'Germany',
            	'GH' => 'Ghana',
            	'GI' => 'Gibraltar',
            	'GR' => 'Greece',
            	'GL' => 'Greenland',
            	'GD' => 'Grenada',
            	'GP' => 'Guadeloupe',
            	'GU' => 'Guam',
            	'GT' => 'Guatemala',
            	'GG' => 'Guernsey',
            	'GN' => 'Guinea',
            	'GW' => 'Guinea-Bissau',
            	'GY' => 'Guyana',
            	'HT' => 'Haiti',
            	'HM' => 'Heard Island & Mcdonald Islands',
            	'VA' => 'Holy See (Vatican City State)',
            	'HN' => 'Honduras',
            	'HK' => 'Hong Kong',
            	'HU' => 'Hungary',
            	'IS' => 'Iceland',
            	'IN' => 'India',
            	'ID' => 'Indonesia',
            	'IR' => 'Iran, Islamic Republic Of',
            	'IQ' => 'Iraq',
            	'IE' => 'Ireland',
            	'IM' => 'Isle Of Man',
            	'IL' => 'Israel',
            	'IT' => 'Italy',
            	'JM' => 'Jamaica',
            	'JP' => 'Japan',
            	'JE' => 'Jersey',
            	'JO' => 'Jordan',
            	'KZ' => 'Kazakhstan',
            	'KE' => 'Kenya',
            	'KI' => 'Kiribati',
            	'KR' => 'Korea',
            	'KW' => 'Kuwait',
            	'KG' => 'Kyrgyzstan',
            	'LA' => 'Lao People\'s Democratic Republic',
            	'LV' => 'Latvia',
            	'LB' => 'Lebanon',
            	'LS' => 'Lesotho',
            	'LR' => 'Liberia',
            	'LY' => 'Libyan Arab Jamahiriya',
            	'LI' => 'Liechtenstein',
            	'LT' => 'Lithuania',
            	'LU' => 'Luxembourg',
            	'MO' => 'Macao',
            	'MK' => 'Macedonia',
            	'MG' => 'Madagascar',
            	'MW' => 'Malawi',
            	'MY' => 'Malaysia',
            	'MV' => 'Maldives',
            	'ML' => 'Mali',
            	'MT' => 'Malta',
            	'MH' => 'Marshall Islands',
            	'MQ' => 'Martinique',
            	'MR' => 'Mauritania',
            	'MU' => 'Mauritius',
            	'YT' => 'Mayotte',
            	'MX' => 'Mexico',
            	'FM' => 'Micronesia, Federated States Of',
            	'MD' => 'Moldova',
            	'MC' => 'Monaco',
            	'MN' => 'Mongolia',
            	'ME' => 'Montenegro',
            	'MS' => 'Montserrat',
            	'MA' => 'Morocco',
            	'MZ' => 'Mozambique',
            	'MM' => 'Myanmar',
            	'NA' => 'Namibia',
            	'NR' => 'Nauru',
            	'NP' => 'Nepal',
            	'NL' => 'Netherlands',
            	'AN' => 'Netherlands Antilles',
            	'NC' => 'New Caledonia',
            	'NZ' => 'New Zealand',
            	'NI' => 'Nicaragua',
            	'NE' => 'Niger',
            	'NG' => 'Nigeria',
            	'NU' => 'Niue',
            	'NF' => 'Norfolk Island',
            	'MP' => 'Northern Mariana Islands',
            	'NO' => 'Norway',
            	'OM' => 'Oman',
            	'PK' => 'Pakistan',
            	'PW' => 'Palau',
            	'PS' => 'Palestinian Territory, Occupied',
            	'PA' => 'Panama',
            	'PG' => 'Papua New Guinea',
            	'PY' => 'Paraguay',
            	'PE' => 'Peru',
            	'PH' => 'Philippines',
            	'PN' => 'Pitcairn',
            	'PL' => 'Poland',
            	'PT' => 'Portugal',
            	'PR' => 'Puerto Rico',
            	'QA' => 'Qatar',
            	'RE' => 'Reunion',
            	'RO' => 'Romania',
            	'RU' => 'Russian Federation',
            	'RW' => 'Rwanda',
            	'BL' => 'Saint Barthelemy',
            	'SH' => 'Saint Helena',
            	'KN' => 'Saint Kitts And Nevis',
            	'LC' => 'Saint Lucia',
            	'MF' => 'Saint Martin',
            	'PM' => 'Saint Pierre And Miquelon',
            	'VC' => 'Saint Vincent And Grenadines',
            	'WS' => 'Samoa',
            	'SM' => 'San Marino',
            	'ST' => 'Sao Tome And Principe',
            	'SA' => 'Saudi Arabia',
            	'SN' => 'Senegal',
            	'RS' => 'Serbia',
            	'SC' => 'Seychelles',
            	'SL' => 'Sierra Leone',
            	'SG' => 'Singapore',
            	'SK' => 'Slovakia',
            	'SI' => 'Slovenia',
            	'SB' => 'Solomon Islands',
            	'SO' => 'Somalia',
            	'ZA' => 'South Africa',
            	'GS' => 'South Georgia And Sandwich Isl.',
            	'ES' => 'Spain',
            	'LK' => 'Sri Lanka',
            	'SD' => 'Sudan',
            	'SR' => 'Suriname',
            	'SJ' => 'Svalbard And Jan Mayen',
            	'SZ' => 'Swaziland',
            	'SE' => 'Sweden',
            	'CH' => 'Switzerland',
            	'SY' => 'Syrian Arab Republic',
            	'TW' => 'Taiwan',
            	'TJ' => 'Tajikistan',
            	'TZ' => 'Tanzania',
            	'TH' => 'Thailand',
            	'TL' => 'Timor-Leste',
            	'TG' => 'Togo',
            	'TK' => 'Tokelau',
            	'TO' => 'Tonga',
            	'TT' => 'Trinidad And Tobago',
            	'TN' => 'Tunisia',
            	'TR' => 'Turkey',
            	'TM' => 'Turkmenistan',
            	'TC' => 'Turks And Caicos Islands',
            	'TV' => 'Tuvalu',
            	'UG' => 'Uganda',
            	'UA' => 'Ukraine',
            	'AE' => 'United Arab Emirates',
            	'GB' => 'United Kingdom',
            	'UM' => 'United States Outlying Islands',
            	'UY' => 'Uruguay',
            	'UZ' => 'Uzbekistan',
            	'VU' => 'Vanuatu',
            	'VE' => 'Venezuela',
            	'VN' => 'Viet Nam',
            	'VG' => 'Virgin Islands, British',
            	'VI' => 'Virgin Islands, U.S.',
            	'WF' => 'Wallis And Futuna',
            	'EH' => 'Western Sahara',
            	'YE' => 'Yemen',
            	'ZM' => 'Zambia',
            	'ZW' => 'Zimbabwe',
            );
        $paises = array_flip($countries); 
        $formMapper->add('pais', ChoiceType::class, [
            'label' => 'Country Code',
            'choices' => $paises
        ]);
        
        /*$formMapper->add('fechaonline',  DatePickerType::class, [
            'disabled' => true,
            'label' => 'Online date',
        ]);*/
        
        $formMapper->add('fechaonline', DateType::class, [
            'widget' => 'choice',
            'label' => 'Online date',
            'years' => range(2018,date('Y')+10),
        ]);
        
        $formMapper->add('fecharodada', DateType::class, [
            'widget' => 'choice',
            'label' => 'Filming date',
            'years' => range(1920,date('Y')+10),
        ]);
        
        $formMapper->add('terminoomdb', TextType::class, [
            'label' => 'IMDB/OMDB $_GET["term"] value',
            'required' => false,
        ]);
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('tipo', null, ['label' => 'Show Episode']);
        $datagridMapper->add('grupo.titulo', null, ['label' => 'Group']);
        $datagridMapper->add('temporada.titulo', null, ['label' => 'Season']);
        $datagridMapper->add('titulo', null, ['label' => 'Title']);
        $datagridMapper->add('thumbsrc', null, ['label' => 'Thumb source']);
        $datagridMapper->add('src', null, ['label' => 'Source']);
        $datagridMapper->add('premium', null, ['label' => 'Premium']);
        $datagridMapper->add('edad', 'doctrine_orm_number', ['label' => 'Minimun age']);
        $datagridMapper->add('director.titulo', null, ['label' => 'Director']);
        $datagridMapper->add('productor.titulo', null, ['label' => 'Producer']);
        $datagridMapper->add('pais', null, ['label' => 'Country Code']);
        $datagridMapper->add('fecharodada', 'doctrine_orm_date', ['label' => 'Filming date'], null, ['years' => range(1920,date('Y'))]);
        $datagridMapper->add('fechaonline', 'doctrine_orm_date', ['label' => 'Online date'], null, ['years' => range(2018,date('Y')+10)]);
        $datagridMapper->add('descripcion', null, ['label' => 'Description']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->add('tipo', null, ['label' => 'Show Episode']);
        $listMapper->addIdentifier('grupo.titulo', null, ['label' => 'Group']);
        $listMapper->addIdentifier('temporada.orden', null, ['label' => 'Season']);
        $listMapper->add('titulo', null, ['label' => 'Title']);
        $listMapper->add('descripcion', null, ['label' => 'Description']);
        $listMapper->add('director.titulo', null, ['label' => 'Director']);
        $listMapper->add('productor.titulo', null, ['label' => 'Producer']);
        $listMapper->add('edad', 'doctrine_orm_number', ['label' => 'Minimun age']);
        $listMapper->add('src', null, ['label' => 'Source']);
        $listMapper->add('thumbsrc', null, ['label' => 'Thumb source']);
        $listMapper->add('premium', null, ['label' => 'Premium']);
        $listMapper->add('pais', null, ['label' => 'Country Code']);
        $listMapper->add('fecharodada', null, ['label' => 'Filming date']);
        $listMapper->add('fechaonline', null, ['label' => 'Online date']);
        
    }
    
    public function prePersist($video) {
        $online = $this->getForm()->get('fechaonline')->getData();
        $filming = $this->getForm()->get('fecharodada')->getData();
        if($online < $filming){
            $video->setFechaonline($this->getForm()->get('fechaonline')->getData());
            $video->setFecharodada($this->getForm()->get('fechaonline')->getData());
        }else{
            $video->setFechaonline($this->getForm()->get('fechaonline')->getData());
            $video->setFecharodada($this->getForm()->get('fecharodada')->getData());
        }
    }
    
    public function preUpdate($video) {
        $online = $this->getForm()->get('fechaonline')->getData();
        $filming = $this->getForm()->get('fecharodada')->getData();
        if($online < $filming){
            $video->setFechaonline($this->getForm()->get('fechaonline')->getData());
            $video->setFecharodada($this->getForm()->get('fechaonline')->getData());
        }else{
            $video->setFechaonline($this->getForm()->get('fechaonline')->getData());
            $video->setFecharodada($this->getForm()->get('fecharodada')->getData());
        }
    }
    
    public function validate(ErrorElement $errorElement, $object)
    {
        if($this->getForm()->get('tipo')->getData() == 0 && !(is_null($this->getForm()->get('grupo')->getData()))){
            if($this->getForm()->get('grupo')->getData()->getTipo() == 1){
                $errorElement->with('file')->addViolation('Field "Group" cannot contain a serie because you have selected a type "Movie" video' );
            }
        }
        
        if($this->getForm()->get('tipo')->getData() == 0 && !(is_null($this->getForm()->get('temporada')->getData()))){
            $errorElement->with('file')->addViolation('Field "Show seasons" must be empty because you have selected a type "Movie" video' );
        }
        
        if($this->getForm()->get('tipo')->getData() == 1 && !(is_null($this->getForm()->get('grupo')->getData()))){
            if($this->getForm()->get('grupo')->getData()->getTipo() == 0){
                $errorElement->with('file')->addViolation('Field "Group" cannot contain a movie because you have selected a type "Show Episode" video' );
            }
        }
        
        if(strtolower($this->getForm()->get('src')->getData()) == 'http://'){
            $errorElement->with('file')->addViolation('Field "Source" cannot contain just http://' );    
        }
        
        if(strtolower($this->getForm()->get('src')->getData()) == 'https://' || $this->getForm()->get('thumbsrc')->getData() == 'https://'){
            $errorElement->with('file')->addViolation('Field "Source" cannot contain just https://' );    
        }
        
        if(strtolower($this->getForm()->get('thumbsrc')->getData()) == 'http://'){
            $errorElement->with('file')->addViolation('Field "Thumb Source" can be empty but cannot contain just http://' );    
        }
        
        if(strtolower($this->getForm()->get('thumbsrc')->getData()) == 'https://' || $this->getForm()->get('thumbsrc')->getData() == 'https://'){
            $errorElement->with('file')->addViolation('Field "Thumb Source" can be empty but cannot contain just https://' );    
        }
        
        if($this->getForm()->get('tipo')->getData() == 1 && !(is_null($this->getForm()->get('temporada')->getData()))){
            if(!(is_null($this->getForm()->get('grupo')->getData()))){
                if( ($this->getForm()->get('temporada')->getData())->getSerie()->getId() != $this->getForm()->get('grupo')->getData()->getId()){
                    $errorElement->with('file')->addViolation('"Show seasons" not related to the "Group" serie' );    
                }       
            }else{
                $errorElement->with('file')->addViolation('Field "Group" cannot be empty if you have selected something in "Show seasons"' );    
            }
            
        }
    }
}