<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 06.03.18
 * Time: 09:42
 */

namespace CoreBundle\Form;

use CoreBundle\Model\Bundle;
use CoreBundle\Model\Configuration;
use CoreBundle\Util\BundlesFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ConfigurationType
 * @package CoreBundle\Form
 */
class ConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bundles', ChoiceType::class, [
                'label' => 'core.configuration.label.bundles',
                'required' => false,
                'choices' => $options['uploaded_bundles'],
                'multiple' => true,
                'expanded' => false,
                'choice_label' => function(Bundle $bundle) {
                    return $bundle->getClassName();
                },
                'choice_value' => function (Bundle $bundle) {
                    return $bundle->getClassName();
                }
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => Configuration::class])
            ->setRequired(['uploaded_bundles']);
    }
}