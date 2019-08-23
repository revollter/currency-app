<?php

namespace App\Form;

use App\Entity\Currency;
use App\Form\Model\CurrencySearchModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currencies', EntityType::class, [
                'label' => 'Select Currencies:',
                'class' => Currency::class,
                'choice_label' => function (Currency $currency) {
                    return $currency->getCode() . ' - ' . $currency->getName();
                },
                'required' => false,
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('dateFrom', DateType::class, [
                'label' => 'From:',
                'widget' => 'single_text'
            ])
            ->add('dateTo', DateType::class, [
                'label' => 'To:',
                'widget' => 'single_text'
            ])
            ->add('find', SubmitType::class, [
                'label' => 'Find',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CurrencySearchModel::class
        ]);
    }
}
