<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\Length;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;
use Sonata\CoreBundle\Validator\ErrorElement;

final class ProductorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('titulo', TextType::class, [
            'required' => true,
            'label' => 'Full Name',
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
        
        $formMapper->add('descripcion', TextareaType::class, [
            'required' => false,
            'label' => 'Description',
        ]);
        
        $formMapper->add('thumbsrc', UrlType::class, [
            'label' => 'Thumb Source',
            'required' => false,
            'constraints' => [
                new Length([
                    'max' => 255,
                    'maxMessage' => 'Exceeded limit, between 0 and 255 characters',
                ]),
            ],
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('titulo', null, ['label' => 'Name']);
        $datagridMapper->add('descripcion', null, ['label' => 'Description']);
        $datagridMapper->add('thumbsrc', null, ['label' => 'Thumb src']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->add('titulo', null, ['label' => 'Name']);
        $listMapper->add('descripcion', null, ['label' => 'Description']);
        $listMapper->add('thumbsrc', null, ['label' => 'Thumb src']);
    }
    
    public function validate(ErrorElement $errorElement, $object)
    {
        if(strtolower($this->getForm()->get('thumbsrc')->getData()) == 'http://'){
            $errorElement->with('file')->addViolation('Field "Thumb Source" can be empty but cannot contain just http://' );    
        }
        
        if(strtolower($this->getForm()->get('thumbsrc')->getData()) == 'https://' || $this->getForm()->get('thumbsrc')->getData() == 'https://'){
            $errorElement->with('file')->addViolation('Field "Thumb Source" can be empty but cannot contain just https://' );    
        }
    }
}