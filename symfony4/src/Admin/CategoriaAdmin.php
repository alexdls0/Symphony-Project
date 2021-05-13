<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;

final class CategoriaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('titulo', TextType::class, [
            'required' => true,
            'label' => 'Category',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexNameSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú in lower or uppercase. It cannot end with space or - or just contain space or -.',
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
        $datagridMapper->add('titulo', null, ['label' => 'Category']);
        $datagridMapper->add('descripcion', null, ['label' => 'Description']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->add('titulo', null, ['label' => 'Category']);
        $listMapper->add('descripcion', null, ['label' => 'Description']);
    }
}