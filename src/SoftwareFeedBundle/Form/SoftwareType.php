<?php

namespace SoftwareFeedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\MongoDB\GridFSFile;

class SoftwareType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
	    ->add('name')
            ->add('description')
            ->add('logo', FileType::class, array(
            	'label' => 'Logo',
            	'data_class' => null
            ))
            ->add('softwareType', EntityType::class, array(
            	'class' => 'SoftwareFeedBundle:SoftwareType',
            	'required' => TRUE
            ))
            ->add('parents')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoftwareFeedBundle\Entity\Software'
        ));
    }
}
