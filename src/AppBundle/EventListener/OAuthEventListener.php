<?php

namespace AppBundle\EventListener;

use FOS\OAuthServerBundle\Event\OAuthEvent;

/**
 * Class: OAuthEventListener.
 */
class OAuthEventListener
{
    /**
     * onPreAuthorizationProcess.
     *
     * @param OAuthEvent $event
     */
    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        //TODO: Always true until extenal clients are allowed
        $event->setAuthorizedClient(true);
    }
}
