<?php

use OHMedia\TimezoneBundle\Util\DateTimeUtil;
use PHPUnit\Framework\TestCase;

final class DateTimeUtilTest extends TestCase
{
    public function testGetDateTimeUtc(): void
    {
        $datetime = DateTimeUtil::getDateTimeUtc();

        $this->assertTrue($datetime instanceof \DateTimeImmutable);

        $this->assertSame($datetime->getTimeZone()->getName(), 'UTC');
    }
}
