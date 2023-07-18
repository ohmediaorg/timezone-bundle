<?php

namespace OHMedia\TimezoneBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimezoneUserTrait
{
    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    protected $timezone;

    public function getTimezone(): string
    {
        return (string) $this->timezone;
    }

    public function setTimezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }
}
