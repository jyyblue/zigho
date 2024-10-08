<?php

namespace Botble\Career\Forms;

use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Career\Http\Requests\CareerRequest;
use Botble\Career\Models\Career;

class CareerForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Career())
            ->setValidatorClass(CareerRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('location', 'text', [
                'label' => trans('plugins/career::career.location'),
                'required' => true,
                'attr' => [
                    'data-counter' => 120,
                ],
            ])
            ->add('salary', 'text', [
                'label' => trans('plugins/career::career.salary'),
                'required' => true,
                'attr' => [
                    'data-counter' => 120,
                ],
            ])
            ->add('content', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->setBreakFieldPoint('status');
    }
}
