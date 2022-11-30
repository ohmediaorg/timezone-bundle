<?php

namespace OHMedia\TimezoneBundle\EventListener;

use OHMedia\TimezoneBundle\Service\Timezone;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TimezoneListener
{
    private $timezone;

    public function __construct(Timezone $timezone)
    {
        $this->timezone = $timezone;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $this->timezone->set();
    }
}
