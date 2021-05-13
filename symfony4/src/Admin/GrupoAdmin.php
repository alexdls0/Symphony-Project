<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use App\Service\ValidationService;

final class GrupoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('titulo', TextType::class, [
            'required' => true,
            'label' => 'Title',
            'trim' => false,
            'constraints' => [
                new Length([
                    'max' => 64,
                    'maxMessage' => 'Exceeded limit, between 1 and 64 characters',
                ]),
                new Regex([
                    'pattern' => ValidationService::regexNameVideoSense(),
                    'message' => 'Can include characters, numbers, space and the special characters: ç, á, é, í, ó, ú,.,_ in lower or uppercase. It cannot end with dot, space or - or just contain space or -.',
                ]),
            ],
        ]);
        
        $formMapper->add('descripcion', TextareaType::class, [
            'required' => false,
            'label' => 'Description',
        ]);
        
        $formMapper->add('tipo', ChoiceType::class, [
            'label' => 'Type',
            'required' => true,
            'choices'  => [
                'Movie Saga' => '0',
                'Show' => '1'
            ],
        ]);
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('titulo', null, ['label' => 'Title']);
        $datagridMapper->add('tipo', null, ['label' => 'Show']);
        $datagridMapper->add('descripcion', null, ['label' => 'Description']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->add('titulo', null, ['label' => 'Title']);
        $listMapper->add('tipo', null, ['label' => 'Show']);
        $listMapper->add('descripcion', null, ['label' => 'Description']);
    }
    
}