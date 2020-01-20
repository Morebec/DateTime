<?php

namespace Test\Morebec\DateTime;

use Cake\Chronos\Chronos;
use DateTime as PHPDateTime;
use Morebec\DateTime\DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    public function test__constructWithString(): void
    {
        $dateString = '2019-09-11 00:00:00';
        $dt = DateTime::fromString($dateString);
        $this->assertEquals($dateString, (string)$dt);
    }


    public function test__toString(): void
    {
        $dateString = '2019-09-11 00:00:00';
        $dt = DateTime::fromString($dateString);
        $this->assertEquals($dateString, (string)$dt);
    }

    public function testFromPHPDateTime(): void
    {
        $dt = new PHPDateTime();

        $this->assertEquals($dt->format(DateTime::DEFAULT_FORMAT), (string)DateTime::fromPHPDateTime($dt));
    }

    public function testNow(): void
    {
        $dt = DateTime::now();
        $this->assertEquals((new PHPDateTime())->format(DateTime::DEFAULT_FORMAT), (string)$dt);
    }

    public function testCreateFromTimestamp(): void
    {
        $ts = 1557792000; // 2019-05-14 00:00:00

        $dt = '2019-05-14 00:00:00';

        $a = Chronos::createFromTimestamp($ts);

        $this->assertEquals($ts, DateTime::fromTimestamp($ts)->getTimestamp());
        $this->assertEquals($dt, (string)DateTime::fromTimestamp($ts));
    }

    public function testGetTimestamp(): void
    {
        $ts = 1557792000; // 2019-05-14 00:00:00

        $dt = '2019-05-14 00:00:00';

        $this->assertEquals($ts, DateTime::fromTimestamp($ts)->getTimestamp());
        $this->assertEquals($ts, DateTime::fromString($dt)->getTimestamp());
    }

    public function testAddMonths()
    {
        $d1 = DateTime::fromString('2019-05-14 00:00:00');
        $d2 = DateTime::fromString('2019-06-14 00:00:00');

        $this->assertEquals($d2, $d1->addMonths(1));
    }

    public function testAddDays()
    {
        $d1 = DateTime::fromString('2019-05-14 00:00:00');
        $d2 = DateTime::fromString('2019-05-15 00:00:00');

        $this->assertEquals($d2, $d1->addDays(1));
    }

    public function testSubtractDays()
    {
        $d1 = DateTime::fromString('2019-05-14 00:00:00');
        $d2 = DateTime::fromString('2019-05-13 00:00:00');

        $this->assertEquals($d2, $d1->subtractDays(1));
    }

    public function testSubtractMonths(): void
    {
        $dt = '2019-01-01 00:00:00';
        $oneMonthLess = '2018-12-01 00:00:00';

        $this->assertEquals($oneMonthLess, (string)DateTime::fromString($dt)->subtractMonths(1));
    }
}
