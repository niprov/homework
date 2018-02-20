<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\FormUpload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'First Name',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('surname', TextType::class, array(
                'label' => 'Surname',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('file', FileType::class, array(
                'label' => 'File (jpg, jpeg, png)',
                'error_bubbling' => 'false',
                'attr' => array(
                    'class' => 'form-control-file',
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Submit',
                'attr' => array(
                    'class' => 'btn btn-outline-primary'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'homeForm';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FormUpload::class,
        ));
    }
}