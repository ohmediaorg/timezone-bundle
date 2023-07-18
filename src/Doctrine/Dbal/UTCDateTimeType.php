<?php

namespace OHMedia\TimezoneBundle\Doctrine\Dbal;

class UTCDateTimeType extends AbstractUTCDateTimeType
{
    protected function convertValue($formatString, $value, \DateTimeZone $tz)
    {
        return \DateTime::createFromFormat($formatString, $value, $tz);
    }
}
