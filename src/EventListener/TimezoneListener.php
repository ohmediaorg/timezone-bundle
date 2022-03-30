<?php

namespace OHMedia\TimezoneBundle\EventListener;

use OHMedia\TimezoneBundle\Traits\TimezoneUser;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TimezoneListener
{
    private $tokenStorage;
    private $defaultTimezone;

    public function __construct(TokenStorageInterface $tokenStorage, $defaultTimezone)
    {
        $this->tokenStorage = $tokenStorage;
        $this->defaultTimezone = $defaultTimezone;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $token = $this->tokenStorage->getToken();

        $user = $token ? $token->getUser() : null;

        $timezone = null;

        if ($user && !in_array(TimezoneUser::class, $this->getTraits($user))) {
            $timezone = $user->getTimezone();
        }

        if (empty($timezone)) {
            $timezone = $this->defaultTimezone;
        }

        date_default_timezone_set($timezone);
    }

    private function getTraits($class)
    {
        $traits = [];

        do {
            $traits = array_merge(class_uses($class), $traits);
        } while($class = get_parent_class($class));

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait), $traits);
        }

        return array_unique($traits);
    }
}
