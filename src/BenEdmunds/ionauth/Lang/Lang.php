<?php

namespace BenEdmunds\IonAuth\Lang;

class Lang
{
    protected $available_languages = [
        'DUTCH' => [__DIR__],
        'CROATIAN'=> [__DIR__],
        'ENGLISH'=> [__DIR__],
        'FRENCH'=> [__DIR__],
        'JAPANESE'=> [__DIR__],
        'RUSSIAN' => [__DIR__]
    ];

    protected $active_language;
    protected $data = [];

    public function __construct($active_language)
    {
        $this->active_language = $active_language;
        $this->read();
    }

    private function read()
    {
        $language = strtoupper($this->active_language);
        if (!in_array($language, array_keys($this->available_languages)))
            throw new \Exception('The Language you\'ve selected is not registered');


        foreach ($this->available_languages[$language] as $lang_file)
        {
            $lang_file .= "/".ucfirst(strtolower($language)).".php";
            if (!is_file($lang_file)) throw new \Exception('File Does Not Exist');

            $this->data = array_merge($this->data, require $lang_file);
        }
        return true;
    }

    public function getSupportedLanguages()
    {
        $languages = array_keys($this->available_languages);

        $languages = array_map(
            function ($language)
            {
                return ucfirst(strtolower($language));
            },
            $languages
        );

        return $languages;
    }

    public function getRegisteredLangFiles()
    {
        return $this->available_languages;
    }

    public function registerLanguage($language, $file_path)
    {
        $this->available_languages[strtoupper($language)][] = $file_path;
        $this->read();
    }

    public function get($value)
    {
        if (!isset($this->data[$value]))
            throw new \Exception('Language Key Does Not Exist in the current language.');

        return $this->data[$value];
    }

    public function getActiveLanguage()
    {
        return $this->active_language;
    }
}
