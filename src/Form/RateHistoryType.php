<?php

namespace App\Form;

use App\Entity\Currency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currency', EntityType::class, [
                'label' => 'Select Currencies:',
                'class' => Currency::class,
                'choice_label' => function (Currency $currency) {
                    return $currency->getCode() . ' - ' . $currency->getName();
                },
                'required' => false,
                'multiple' => true,
                'expanded' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
