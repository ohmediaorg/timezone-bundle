<?php

namespace OHMedia\TimezoneBundle\Doctrine\Dbal;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

abstract class AbstractUTCDateTimeType extends DateTimeType
{
    abstract protected function convertValue($formatString, $value, \DateTimeZone $tz);

    /**
     * @var \DateTimeZone
     */
    private static $utc;

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof \DateTimeInterface) {
            $value = $value->setTimezone(self::getUtc());
        }

        return parent::convertToDatabaseValue($value, $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (null === $value || $value instanceof \DateTimeInterface) {
            return $value;
        }

        $converted = $this->convertValue(
            $platform->getDateTimeFormatString(),
            $value,
            self::getUtc()
        );

        if (!$converted) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateTimeFormatString());
        }

        return $converted;
    }

    private static function getUtc(): \DateTimeZone
    {
        return self::$utc ?: self::$utc = new \DateTimeZone('UTC');
    }
}
