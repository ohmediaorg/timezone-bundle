<?php

namespace OHMedia\TimezoneBundle\Util;

final class DateTimeUtil
{
    private static $utc;

    public static function getDateTimeUtc(string $datetime = 'now'): \DateTimeImmutable
    {
        return new \DateTimeImmutable($datetime, self::getDateTimeZoneUtc());
    }

    public static function getDateTimeZoneUtc(): \DateTimeZone
    {
        if (null === self::$utc) {
            self::$utc = new \DateTimeZone('UTC');
        }

        return self::$utc;
    }

    public static function isFuture(\DateTimeInterface $datetime): bool
    {
        $clone = clone $datetime;
        $clone->setTimezone(self::getDateTimeZoneUtc());

        return $clone > self::getDateTimeUtc();
    }

    public static function isPast(\DateTimeInterface $datetime): bool
    {
        return !self::isFuture($datetime);
    }
}
