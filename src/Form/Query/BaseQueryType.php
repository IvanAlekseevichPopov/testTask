<?php

declare(strict_types=1);

namespace App\Form\Query;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class BaseQueryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('page', IntegerType::class, [
                'constraints' => [
                    new GreaterThanOrEqual(['value' => 1]),
                ],
            ])
            ->add('perPage', IntegerType::class, [
                'constraints' => [
                    new Range(['min' => 1, 'max' => 100]),
                ],
            ])
            ->add('sortBy', ChoiceType::class, [
                'choices' => ['id', 'createdAt'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('sortOrder', ChoiceType::class, [
                'choices' => ['ASC', 'DESC'],
                'constraints' => [
                    new NotBlank(),
                ],
            ]);
    }
}
