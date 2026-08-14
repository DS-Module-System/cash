<?php

namespace App\Form\Cash;

use App\Entity\Cash\CashTransaction;
use App\Enum\Cash\CashTransactionType;
use App\Form\Core\DefaultForm\EditForm;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class CashTransactionForm extends EditForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('transactionDate', DateType::class, [
                'label' => 'transactionDate',
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['data-datepicker' => '{}'],
                'input' => 'datetime_immutable',
                'empty_data' => '0000-00-00',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('amount', NumberType::class, [
                'label' => 'amount',
                'scale' => 2,
                'constraints' => [
                    new NotBlank(),
                    new Positive(),
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => '0.00',
                ],
            ])
            ->add('transactionType', EnumType::class, [
                'label' => 'transactionType',
                'class' => CashTransactionType::class,
                'choice_label' => 'label',
                'constraints' => [
                    new NotBlank(),
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CashTransaction::class,
            'translation_domain' => 'cash',
        ]);
    }
} 