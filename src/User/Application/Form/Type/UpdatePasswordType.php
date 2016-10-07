<?php

namespace Black\User\Application\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UpdatePasswordType
 */
class UpdatePasswordType extends AbstractType
{
    /**
     * @var
     */
    protected $class;

    /**
     * UpdatePasswordType constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'black_user.form.password.invalid',
                    'first_options' => [
                        'label' => 'black_user.form.password.password.label'
                    ],
                    'second_options' => [
                        'label' => 'black_user.form.password.password_repeat.label'
                    ],
                    'options' => [
                        'required' => true,
                    ],
                ]
            );
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->class,
                'empty_data' => function (FormInterface $form) {
                    return new $this->class(
                        $form->get('id')->getData(),
                        $form->get('password')->getData()
                    );
                },
                'translation_domain' => 'form',
            ]
        );
    }
}
