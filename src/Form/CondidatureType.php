<?php

namespace App\Form;

use App\Entity\Condidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomCondidat')
            ->add('PrenomCondidat')
            ->add('AgeCondidat')
            ->add('NumTelCondidat')
            ->add('MailCondidat')
            ->add('AdressVille')
            ->add('LienLinkedin')
            ->add('LienGithub')
            ->add('CvCondidat')
            ->add('IdAnnonce')
            ->add('IdCondidat')
            ->add('IdEntretien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Condidature::class,
        ]);
    }
}
