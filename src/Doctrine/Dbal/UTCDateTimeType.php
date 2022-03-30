<?php

namespace OHMedia\TimezoneBundle\Doctrine\Dbal;

use DateTime;
use DateTimeZone;

class UTCDateTimeType extends AbstractUTCDateTimeType
{
    protected function convertValue($formatString, $value, DateTimeZone $tz)
    {
        return DateTime::createFromFormat($formatString, $value, $tz);
    }
}
