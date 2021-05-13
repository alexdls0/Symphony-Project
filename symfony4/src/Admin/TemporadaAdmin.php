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
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;
use Sonata\CoreBundle\Validator\ErrorElement;

final class TemporadaAdmin extends AbstractAdmin
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
        
        $formMapper->add('serie', ModelListType::class, [
            'label' => 'Serie',
            'required' => true,
            'btn_edit' => false,
        ]);
        
        $formMapper->add('orden', IntegerType::class, [
            'required' => true,
            'trim' => false,
            'label' => 'Season number',
            'constraints' => [
                new Length([
                    'max' => 2,
                    'maxMessage' => 'Exceeded limit, between 1 and 2 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexOneOrTwoDigits(),
                    'message' => 'The season number must be an integer between 1 and 99',
                ]),
            ],
        ]);
        
        $formMapper->add('descripcion', TextareaType::class, [
            'required' => false,
            'label' => 'Description',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('serie.titulo', null, ['label' => 'Serie']);
        $datagridMapper->add('orden', 'doctrine_orm_number', ['label' => 'Season number']);
        $datagridMapper->add('titulo', null, ['label' => 'Title']);
        $datagridMapper->add('descripcion', null, ['label' => 'Description']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->addIdentifier('serie.titulo', null, ['label' => 'Serie']);
        $listMapper->add('orden', 'doctrine_orm_number', ['label' => 'Season number']);
        $listMapper->add('titulo', null, ['label' => 'Title']);
        $listMapper->add('descripcion', null, ['label' => 'Description']);
    }
    
    
    public function validate(ErrorElement $errorElement, $object)
    {
        if(is_null($this->getForm()->get('serie')->getData())){
            $errorElement->with('file')->addViolation('Field "Serie" cannot be empty' );
        }else{
            if(($this->getForm()->get('serie')->getData())->getTipo() == 0){
                $errorElement->with('file')->addViolation('Field "Serie" cannot be related to a movie' ); 
            }
        }
    }
    
}