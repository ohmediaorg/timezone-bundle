<?php

namespace OHMedia\TimezoneBundle\Doctrine\Dbal;

use DateTimeImmutable;
use DateTimeZone;

class UTCDateTimeImmutableType extends AbstractUTCDateTimeType
{
    protected function convertValue($formatString, $value, DateTimeZone $tz)
    {
        return DateTimeImmutable::createFromFormat($formatString, $value, $tz);
    }
}
