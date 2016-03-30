<?php

namespace Adlpz\ECTBundle\Twig;

use Adlpz\ECTBundle\ContentTranslator;

class ECTBundleExtension extends \Twig_Extension
{

    /**
     * @var ContentTranslator
     */
    private $contentTranslator;

    /**
     * ECTBundleExtension constructor.
     * @param ContentTranslator $contentTranslator
     */
    public function __construct(ContentTranslator $contentTranslator)
    {
        $this->contentTranslator = $contentTranslator;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getTranslatedContent', function ($object, $property) {
                return $this->contentTranslator->getTranslatedContent($object, $property);
            }, ['is_safe' => ['html']])
        ];
    }

    public function getName()
    {
        return 'ect_twig_extension';
    }
}