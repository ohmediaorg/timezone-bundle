<?php

namespace OHMedia\TimezoneBundle\EventListener;

use OHMedia\TimezoneBundle\Service\Timezone;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TimezoneListener
{
    public function __construct(private Timezone $timezone)
    {
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $this->timezone->set();
    }
}
