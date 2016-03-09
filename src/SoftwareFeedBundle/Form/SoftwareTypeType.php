<?php

namespace SoftwareFeedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SoftwareTypeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
				'required' => TRUE,
				'attr' => array(
					'id' => 'name',
        			'class' => 'form-control'
				),
				'label_attr' => array(
					'for' => 'name'
				)
			))
            ->add('description', TextareaType::class, array(
				'required' => TRUE,
				'attr' => array(
					'id' => 'description',
        			'class' => 'form-control'
				),
				'label_attr' => array(
					'for' => 'description'
				)
			))
            ->add('parent', EntityType::class, array(
    			'class' => 'SoftwareFeedBundle:SoftwareType',
				'required' => FALSE,
    			'choice_label' => 'name',
				'attr' => array(
					'id' => 'parent',
        			'class' => 'form-control'
				),
				'label_attr' => array(
					'for' => 'parent'
				)
			))
			->add('submit', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoftwareFeedBundle\Entity\SoftwareType'
        ));
    }
}
