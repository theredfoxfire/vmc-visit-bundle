<?php

namespace Vmc\VisitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VisitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patient_id')
            ->add('date')
            ->add('keluhan')
            ->add('pemeriksaan_fisik')
            ->add('diagnosis')
            ->add('tindakan')
            ->add('obat')
            ->add('biaya')
            ->add('is_delete')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vmc\VisitBundle\Entity\Visit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vmc_visitbundle_visit';
    }
}
