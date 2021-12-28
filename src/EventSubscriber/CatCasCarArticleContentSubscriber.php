<?php

namespace App\EventSubscriber;

use CatCasCarSymfony\ArticleContentProviderBundle\Event\OnBeforeWordPasteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CatCasCarArticleContentSubscriber implements EventSubscriberInterface
{
    public function onBeforeWordPaste(OnBeforeWordPasteEvent $event)
    {
        $event->setWord('Место для Вашей рекламы');
    }
    public static function getSubscribedEvents()
    {
        return [
            OnBeforeWordPasteEvent::class => 'onBeforeWordPaste'
        ];
    }


}