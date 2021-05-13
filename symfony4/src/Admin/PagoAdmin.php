<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Validator\ErrorElement;

final class PagoAdmin extends AbstractAdmin
{
    
    protected function configureRoutes(RouteCollection $collection)
    {
        //Users use the register form to create
        $collection->remove('create');
        $collection->remove('delete');
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper->add('cuentausuario', ModelType::class, [
            'required' => true,
            'property' => 'correo',
            'label' => 'User email',
            'disabled' => true,
            ]
        );

        $formMapper->add('fecha',  DateTimePickerType::class, [
            'disabled' => true,
            'label' => 'Date',
        ]);
        
        $formMapper->add('nombretitular', TextType::class, [
            'required' => true,
            'label' => 'Owner name',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('apellidotitular', TextType::class, [
            'required' => true,
            'label' => 'Owner Surname',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexRealNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('empresatarjeta', TextType::class, [
            'required' => false,
            'label' => 'Card company',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('numerotarjeta', IntegerType::class, [
            'disabled' => true,
            'required' => true,
            'label' => 'Card number',
            'constraints' => [
                new Length([
                    'min' => 13,
                    'minMessage' => 'A credit card must have at least 13 digits',
                    'max' => 18,
                    'maxMessage' => 'Exceeded limit, a credit card has between 13 and 18 digits',
                ]),
            ],
        ]);
        
        $formMapper->add('cvv', IntegerType::class, [
            'disabled' => true,
            'required' => true,
            'label' => 'Card Verification Value',
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'Must contain at least 3 digits',
                    'max' => 4,
                    'maxMessage' => 'Exceeded limit, 3-4 digits',
                ]),
            ],
        ]);
        
        $formMapper->add('importe', NumberType::class, [
            'required' => true,
            'label' => 'Amount',
            'constraints' => [
                new Length([
                    'max' => 7,
                    'maxMessage' => 'Exceeded limit',
                ]),
            ],
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('cuentausuario.apodo', null, ['label' => 'User nick']);
        $datagridMapper->add('nombretitular', null, ['label' => 'Owner name']);
        $datagridMapper->add('apellidotitular', null, ['label' => 'Owner surname']);
        $datagridMapper->add('empresatarjeta', null, ['label' => 'Company']);
        $datagridMapper->add('numerotarjeta', 'doctrine_orm_number', ['label' => 'Card']);
        $datagridMapper->add('cvv', 'doctrine_orm_number', ['label' => 'CVV']);
        $datagridMapper->add('fecha', 'doctrine_orm_date', ['label' => 'Date'], null, ['years' => range(2019,date('Y'))]);
        $datagridMapper->add('importe', 'doctrine_orm_number', ['label' => 'Amount']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->addIdentifier('cuentausuario.apodo', null, ['label' => 'User nick']);
        $listMapper->add('nombretitular', null, ['label' => 'Owner name']);
        $listMapper->add('apellidotitular', null, ['label' => 'Owner surname']);
        $listMapper->add('empresatarjeta', null, ['label' => 'Company']);
        $listMapper->add('numerotarjeta', 'doctrine_orm_number', ['label' => 'Card']);
        $listMapper->add('cvv', 'doctrine_orm_number', ['label' => 'CVV']);
        $listMapper->add('fecha', null, ['label' => 'Date']);
        $listMapper->add('importe', 'doctrine_orm_number', ['label' => 'Amount']);
    }
    
    /*public function validate(ErrorElement $errorElement, $object)
    {
        if(is_null($this->getForm()->get('cuentausuario')->getData())){
            $errorElement->with('file')->addViolation('Field "User" cannot be empty' );    
        }
    }*/
}