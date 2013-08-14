<?php

namespace mgate\PersonneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use mgate\CommentBundle\Form\ThreadType;
use \mgate\PersonneBundle\Entity\Prospect;

class ProspectType extends AbstractType {

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text')
                ->add('entite', 'choice', array('choices' => Prospect::getEntiteChoice(), 'required' => false))
                ->add('adresse', 'text', array('required' => false));
    }

    public function getName() {
        return 'mgate_suivibundle_prospecttype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'mgate\PersonneBundle\Entity\Prospect',
        ));
    }

}

