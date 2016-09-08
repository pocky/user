<?php

namespace Black\Component\User\Application\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType
 */
class LoginType extends AbstractType
{
    /**
     * @var
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name  = $name;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', [
                'label' => 'black_user.form.login.username.label',
                'attr' => [
                    'placeholder' => 'black_user.form.login.username.placeholder',
                ]
            ])
            ->add('password', 'password', [
                'label' => 'black_user.form.login.password.label',
                'attr' => [
                    'placeholder' => 'black_user.form.login.password.placeholder',
                ]
            ])
            ->add('remember_me', 'checkbox', [
                'label' => 'black_user.form.login.rememberMe.label',
                'required' => false,
            ])
            ->add('submit', 'submit', [
                'label' => 'black_user.form.login.submit.label',
                'attr' => [
                    'class' => 'btn bg-olive btn-block'
                ]
            ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'translation_domain' => 'form',
                'intention' => 'admin_authentication'
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
