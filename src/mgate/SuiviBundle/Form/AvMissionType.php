<?php

namespace mgate\SuiviBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;

use mgate\PersonneBundle\Form;

class AvMissionType extends DocTypeType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {   
        //DocTypeType::buildForm($builder,$options);
    }

    public function getName()
    {
        return 'mgate_suivibundle_avmssiontype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
            'data_class' => 'mgate\SuiviBundle\Entity\AvMission',
        );
    }
}


