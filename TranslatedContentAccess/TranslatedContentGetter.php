<?php

namespace Adlpz\ECTBundle\TranslatedContentAccess;


use Adlpz\ECTBundle\Entity\TranslatedContent;
use Doctrine\Common\Collections\ArrayCollection;

class TranslatedContentGetter
{
    /**
     * @param $object
     * @param $property
     * @param $language
     * @param array $options
     * @return string
     */
    public static function getTranslatedContent($object, $property, $language, array $options = [])
    {
        $options = [
            'fallbackLanguage' => isset($options['fallbackLanguage']) ? $options['fallbackLanguage'] : false,
            'fallbackToFirst' => isset($options['fallbackToFirst']) ? $options['fallbackToFirst'] : false,
            'fallbackProperty' => isset($options['fallbackProperty']) ? $options['fallbackProperty'] : false
        ];

        $translations = self::getProperty($object, $property);

        foreach ($translations as $translatedContent) {
            if ($translatedContent->getLanguage() == $language) {
                return $translatedContent->getContent();
            }
        }

        if ($options['fallbackLanguage']) {
            foreach ($translations as $translatedContent) {
                if ($translatedContent->getLanguage() == $options['fallbackLanguage']) {
                    return $translatedContent->getContent();
                }
            }
        }

        if ($options['fallbackToFirst']) {
            if (count($translations)) {
                return $translations[0]->getContent();
            }
        }

        if ($options['fallbackProperty']) {
            return self::getProperty($object, $options['fallbackProperty']);
        }

        return '';
    }

    /**
     * @param $object
     * @param $property
     * @return TranslatedContent[]|string
     */
    private static function getProperty($object, $property)
    {
        $getter = 'get' . ucfirst($property);
        /** @var TranslatedContent[]|ArrayCollection $translations */
        if (method_exists($object, $getter)) {
            $translations = $object->$getter();
            return $translations;
        } else {
            $r = new \ReflectionProperty(get_class($object), $property);
            $r->setAccessible(true);
            $translations = $r->getValue($object);
            return $translations;
        }
    }

}