<?php

namespace spec\BenEdmunds\IonAuth\Lang;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LangSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('English');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('BenEdmunds\IonAuth\Lang\Lang');
    }

    function it_cannot_read_an_unsupported_language()
    {
        $this->shouldThrow('\Exception')->during('__construct', array('fakity_fake_fake'));
    }

    function it_can_register_a_new_language()
    {
        $this->registerLanguage('BeepBeepBoopBoop', 'path/to/file');
        $this->getSupportedLanguages()->shouldContain('Beepbeepboopboop');
    }

    function it_can_extend_a_language()
    {
        $this->registerLanguage('Dutch', 'path/to/file');

        $languages = $this->getRegisteredLangFiles();
        $languages['DUTCH']->shouldBeArray();
        $languages['DUTCH']->shouldContain('path/to/file');
    }

    function it_can_get_a_language_value()
    {
        $this->get('activateSuccessful')->shouldReturn('Account activated');
    }

    function it_can_return_active_language()
    {
        $this->getActiveLanguage()->shouldReturn('English');
    }

    public function getMatchers()
    {
        return [
            'contain' => function($subject, $key) {
                return in_array($key, $subject);
            },
        ];
    }
}
