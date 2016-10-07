<?php

namespace Black\User\Application\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType
 */
class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class, [
                'label' => 'black_user.form.login.username.label',
                'attr' => [
                    'placeholder' => 'black_user.form.login.username.placeholder',
                ]
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'black_user.form.login.password.label',
                'attr' => [
                    'placeholder' => 'black_user.form.login.password.placeholder',
                ]
            ])
            ->add('_remember_me', CheckboxType::class, [
                'label' => 'black_user.form.login.rememberMe.label',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'black_user.form.login.submit.label',
            ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'form',
            'intention' => 'admin_authentication'
        ]);
    }
}
