<?php

namespace Black\Component\User\Application\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UpdateAccountType
 */
class UpdateAccountType extends AbstractType
{
    /**
     * @var type
     */
    protected $class;

    /**
     * @var
     */
    protected $name;

    /**
     * @param $class
     * @param $name
     */
    public function __construct($class, $name)
    {
        $this->class = $class;
        $this->name  = $name;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden')
            ->add('name', 'text', [
                    'label'  => 'black_user.form.account.name.label',
                    'required' => true,
                ]
            )
            ->add('email', 'text', [
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
                        $form->get('id')->getData(),
                        $form->get('name')->getData(),
                        $form->get('email')->getData()
                    );
                },
                'translation_domain' => 'form',
            ]
        );
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
