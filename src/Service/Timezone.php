<?php

namespace OHMedia\TimezoneBundle\Service;

use OHMedia\TimezoneBundle\Traits\TimezoneUserTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Timezone
{
    private $tokenStorage;
    private $defaultTimezone;

    public function __construct(TokenStorageInterface $tokenStorage, $defaultTimezone)
    {
        $this->tokenStorage = $tokenStorage;
        $this->defaultTimezone = $defaultTimezone;
    }

    public function set(): self
    {
        $token = $this->tokenStorage->getToken();

        $user = $token ? $token->getUser() : null;

        $timezone = null;

        if ($user && !in_array(TimezoneUserTrait::class, $this->getTraits($user))) {
            $timezone = $user->getTimezone();
        }

        if (empty($timezone)) {
            $timezone = $this->defaultTimezone;
        }

        date_default_timezone_set($timezone);

        return $this;
    }

    public function get(): string
    {
        $this->set();

        return date_default_timezone_get();
    }

    private function getTraits($class): array
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
