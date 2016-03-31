<?php

namespace Adlpz\ECTBundle\Form;


use Adlpz\ECTBundle\Entity\TranslatedContent;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslatedContentFieldType extends BaseType
{
    /**
     * @var array
     */
    private $languages;

    /**
     * TranslatedContentFieldType constructor.
     * @param array $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('language', 'choice', array_combine($this->languages, $this->languages))
            ->add('content');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'ect_translated_content_type';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('data_class', TranslatedContent::class);
    }


}