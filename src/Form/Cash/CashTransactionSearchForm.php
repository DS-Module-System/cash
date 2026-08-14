<?php

namespace App\Form\Cash;

use App\Enum\Cash\CashTransactionType;
use App\Form\Core\DefaultForm\SearchForm;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CashTransactionSearchForm extends SearchForm
{
    public function __construct(
        private RequestStack $requestStack,
        private UrlGeneratorInterface $router
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('transactionDateFrom', DateType::class, [
                'label' => 'transactionDateFrom',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['data-datepicker' => '{}'],
                'input' => 'datetime_immutable',
            ])
            ->add('transactionDateTo', DateType::class, [
                'label' => 'transactionDateTo',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['data-datepicker' => '{}'],
                'input' => 'datetime_immutable',
            ])
            ->add('amountFrom', NumberType::class, [
                'label' => 'amountFrom',
                'required' => false,
                'scale' => 2,
                'attr' => [
                    'placeholder' => '0.00',
                ],
            ])
            ->add('amountTo', NumberType::class, [
                'label' => 'amountTo',
                'required' => false,
                'scale' => 2,
                'attr' => [
                    'placeholder' => '0.00',
                ],
            ])
            ->add('transactionType', EnumType::class, [
                'label' => 'transactionType',
                'class' => CashTransactionType::class,
                'choice_label' => 'label',
                'required' => false, 
                'placeholder' => 'allTypes',
            ])
            ->add('createdBy', TextType::class, [
                'label' => 'createdBy',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request) {
            $resolver->setDefault('action', $this->router->generate($request->get('_route'),
                array_merge($request->get('_route_params'), ['page' => 1])));
        }
        $resolver->setDefault('translation_domain', 'cash');
    }
} 