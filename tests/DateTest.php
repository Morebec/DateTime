<?php

namespace Test\Morebec\DateTime;

use DateTime as PHPDateTime;
use Morebec\DateTime\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function test__constructWithString(): void
    {
        $dateString = '2019-09-11';
        $dt = Date::fromString($dateString);
        $this->assertEquals($dateString, (string)$dt);
    }


    public function test__toString(): void
    {
        $dateString = '2019-09-11';
        $dt = Date::fromString($dateString);
        $this->assertEquals($dateString, (string)$dt);
    }

    public function testFromPHPDateTime(): void
    {
        $dt = new PHPDateTime();

        $this->assertEquals($dt->format(Date::DEFAULT_FORMAT), (string)Date::fromPHPDateTime($dt));
    }

    public function testNow(): void
    {
        $dt = Date::now();
        $this->assertEquals((new PHPDateTime())->format(Date::DEFAULT_FORMAT), (string)$dt);
    }

    public function testCreateFromTimestamp(): void
    {
        $ts = 1557792000; // 2019-05-14

        $dt = '2019-05-14';

        $this->assertEquals($ts, Date::fromTimestamp($ts)->getTimestamp());
        $this->assertEquals($dt, (string)Date::fromTimestamp($ts));
    }

    public function testGetTimestamp(): void
    {
        $ts = 1557792000; // 2019-05-14

        $dt = '2019-05-14';

        $this->assertEquals($ts, Date::fromTimestamp($ts)->getTimestamp());
        $this->assertEquals($ts, Date::fromString($dt)->getTimestamp());
    }

    public function testAddMonths()
    {
        $d1 = Date::fromString('2019-05-14');
        $d2 = Date::fromString('2019-06-14');

        $this->assertEquals($d2, $d1->addMonths(1));
    }

    public function testAddDays()
    {
        $d1 = Date::fromString('2019-05-14');
        $d2 = Date::fromString('2019-05-15');

        $this->assertEquals($d2, $d1->addDays(1));
    }

    public function testSubtractDays()
    {
        $d1 = Date::fromString('2019-05-14');
        $d2 = Date::fromString('2019-05-13');

        $this->assertEquals($d2, $d1->subtractDays(1));
    }

    public function testSubtractMonths(): void
    {
        $dt = '2019-01-01';
        $oneMonthLess = '2018-12-01';

        $this->assertEquals($oneMonthLess, (string)Date::fromString($dt)->subtractMonths(1));
    }
}
