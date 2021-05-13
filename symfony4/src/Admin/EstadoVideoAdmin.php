<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
//Tipos de datos
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use App\Service\ValidationService;
use Sonata\Form\Type\DateTimePickerType;
use Sonata\CoreBundle\Validator\ErrorElement;

final class EstadoVideoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('video', ModelListType::class, [
            'label' => 'Video',
            'required' => true,
            'btn_edit' => false,
        ]);
        
        $formMapper->add('usuario', ModelListType::class, [
            'label' => 'User',
            'required' => true,
            'btn_edit' => false,
        ]);
        
        $formMapper->add('tiempo', IntegerType::class, [
            'required' => true,
            'label' => 'Seconds viewed',
            'attr' => array('min' => 0, 'max' => 14400),
            'constraints' => [
                new Length([
                    'min' => 1,
                    'max' => 5,
                    'maxMessage' => 'Exceeded limit, the maximum time we admit is a total of 4 hours, 14400 seconds',
                ]),
            ],
        ]);
        
        $formMapper->add('tiempototal', IntegerType::class, [
            'required' => true,
            'label' => 'Total of seconds of the video',
            'attr' => array('min' => 0, 'max' => 14400),
            'constraints' => [
                new Length([
                    'min' => 1,
                    'max' => 5,
                    'maxMessage' => 'Exceeded limit, the maximum time we admit is a total of 4 hours, 14400 seconds',
                ]),
            ],
        ]);
        
        $formMapper->add('completo', ChoiceType::class,array('choices' => array(
            "No" => '0',
            "Yes" => '1'),
            'label' => 'Viewed',
            'expanded'=>true,
            'attr' => array('disabled'=>true),
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $datagridMapper->add('usuario.apodo', null, ['label' => 'User nick']);
        $datagridMapper->add('video.titulo', null, ['label' => 'Video Title']);
        $datagridMapper->add('completo', null, ['label' => 'Viewed']);
        $datagridMapper->add('tiempo', 'doctrine_orm_number', ['label' => 'Time']);
        $datagridMapper->add('tiempototal', 'doctrine_orm_number', ['label' => 'Total Time']);
        $datagridMapper->add('porcentaje', 'doctrine_orm_number', ['label' => 'Progress']);
        $datagridMapper->add('modificado', 'doctrine_orm_date', ['label' => 'Last interaction']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', 'doctrine_orm_number', ['label' => 'Identifier']);
        $listMapper->addIdentifier('usuario.apodo', null, ['label' => 'User Login']);
        $listMapper->addIdentifier('video.titulo', null, ['label' => 'Video Title']);
        $listMapper->add('completo', null, ['label' => 'Viewed']);
        $listMapper->add('tiempo', 'doctrine_orm_number', ['label' => 'Time']);
        $listMapper->add('tiempototal', 'doctrine_orm_number', ['label' => 'Total Time']);
        $listMapper->add('porcentaje', 'doctrine_orm_number', ['label' => 'Progress']);
        $listMapper->add('modificado', null, ['label' => 'Last interaction']);
    }
    
    public function prePersist($status) {
        //Modifies data depending on completion
        $total = (int)$this->getForm()->get('tiempototal')->getData();
        $parte = (int)$this->getForm()->get('tiempo')->getData();
        $actual = date("Y-m-d H:i:s");
        $status->setModificado(\DateTime::createFromFormat('Y-m-d H:i:s', $actual));
        if($parte <$total){
            $porcent = $parte * 100 / $total;
            $status->setPorcentaje($porcent);
        }else{
            $status->setTiempo($this->getForm()->get('tiempototal')->getData());
            $status->setPorcentaje('100');
        }
    }
    
    public function preUpdate($status) {
        //Modifies data depending on completion
        $total = (int)$this->getForm()->get('tiempototal')->getData();
        $parte = (int)$this->getForm()->get('tiempo')->getData();
        $actual = date("Y-m-d H:i:s");
        $status->setModificado(\DateTime::createFromFormat('Y-m-d H:i:s', $actual));
        
        if($parte <$total){
            $porcent = $parte * 100 / $total;
            $status->setPorcentaje($porcent);
        }else{
            $status->setTiempo($this->getForm()->get('tiempototal')->getData());
            $status->setPorcentaje('100');
        }
    }
    
    public function validate(ErrorElement $errorElement, $object)
    {
        //Error display
        if(is_null($this->getForm()->get('video')->getData())){
            $errorElement->with('file')->addViolation('Field "Video" cannot be empty' );    
        }
        
        if(is_null($this->getForm()->get('usuario')->getData())){
            $errorElement->with('file')->addViolation('Field "User" cannot be empty' );    
        }
    }
}