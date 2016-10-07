<?php

namespace Black\User\Application\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CreateAccountType
 */
class CreateAccountType extends AbstractType
{
    /**
     * @var
     */
    protected $class;

    /**
     * CreateAccountType constructor.
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
            ->add('name', TextType::class, [
                    'label'  => 'black_user.form.account.name.label',
                    'required' => true,
                ]
            )
            ->add('email', TextType::class, [
                    'label'  => 'black_user.form.account.email.label',
                    'required' => true,
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
                        $form->get('name')->getData(),
                        $form->get('email')->getData()
                    );
                },
                'translation_domain' => 'form',
            ]
        );
    }
}
