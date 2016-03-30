<?php

namespace Adlpz\ECTBundle;


use Adlpz\ECTBundle\TranslatedContentAccess\TranslatedContentGetter;
use Symfony\Component\HttpFoundation\RequestStack;

class ContentTranslator
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    /**
     * @param $object
     * @param $property
     * @return string
     */
    public function getTranslatedContent($object, $property)
    {
        return TranslatedContentGetter::getTranslatedContent($object, $property, $this->getLocale());
    }

    private function getLocale()
    {
        return $this->requestStack->getMasterRequest()->getLocale();
    }

}