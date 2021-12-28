<?php

namespace App\Service;

use CatCasCarSymfony\ArticleContentProviderBundle\WordDecoratorInterface;

class RedHtmlWordDecorator implements WordDecoratorInterface
{
    public function decorate(string $word, bool $isBold = true): string
    {
        if ($isBold) {
            return '<strong style="color: red;">' . $word . '</strong>';
        }

        return '<i style="color: red;">' . $word . '</i>';
    }

}