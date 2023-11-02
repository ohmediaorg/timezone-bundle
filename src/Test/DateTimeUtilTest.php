<?php

use OHMedia\TimezoneBundle\Util\DateTimeUtil;
use PHPUnit\Framework\TestCase;

final class DateTimeUtilTest extends TestCase
{
    public function testGetDateTimeUtc(): void
    {
        $string = 'tomorrow';

        $datetime1 = new \DateTimeImmutable($string, new \DateTimeZone('UTC'));

        $datetime2 = DateTimeUtil::getDateTimeUtc($string);

        $this->assertEquals($datetime1, $datetime2);
    }

    public function testGetDateTimeZoneUtc(): void
    {
        $timezone = DateTimeUtil::getDateTimeZoneUtc();

        $this->assertSame($timezone->getName(), 'UTC');
    }

    public function testIsFutureAndIsPast(): void
    {
        $tomorrow = new \DateTime('tomorrow');
        $yesterday = new \DateTime('yesterday');

        $this->assertTrue(DateTimeUtil::isFuture($tomorrow));

        $this->assertFalse(DateTimeUtil::isFuture($yesterday));

        $this->assertTrue(DateTimeUtil::isPast($yesterday));

        $this->assertFalse(DateTimeUtil::isPast($tomorrow));
    }
}
