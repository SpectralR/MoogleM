<?php

namespace App\Services\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class Policy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::FONT, Keyword::SELF);
        $this->addDirective(Directive::FONT, 'https://fonts.gstatic.com/');
        $this->addDirective(Directive::FONT, 'https://kit-free.fontawesome.com/');
        $this->addDirective(Directive::IMG, 'https://img2.finalfantasyxiv.com/');
        $this->addDirective(Directive::IMG, 'https://xivapi.com/');
        $this->addDirective(Directive::SCRIPT, 'https://kit.fontawesome.com/');
        $this->addDirective(Directive::SCRIPT, 'https://ajax.googleapis.com/');
        $this->addDirective(Directive::STYLE, 'https://kit-free.fontawesome.com/');
        $this->addDirective(Directive::STYLE, 'https://fonts.googleapis.com/');
        $this->addNonceForDirective(Directive::STYLE);
    }
}
