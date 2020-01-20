<?php

namespace Tests\Morebec\DateTime;


use DateTime as PHPDateTime;
use Morebec\DateTime\DateTime;
use Morebec\DateTime\SystemClock;
use PHPUnit\Framework\TestCase;

class SystemClockTest extends TestCase
{

    public function testSet()
    {
        $date = DateTime::fromString('2014/05/10');
        SystemClock::set($date);
        $this->assertEquals($date, SystemClock::now());
        SystemClock::reset();
    }

    public function testNow()
    {
        $date = new PHPDateTime();
        $now = SystemClock::now();
        $this->assertEquals($date->format(DateTime::DEFAULT_FORMAT), (string)$now);
    }

    public function testTimestamp()
    {
        $time = time();
        $this->assertEquals($time, SystemClock::timestamp());
    }

    public function testReset()
    {
        $date = DateTime::fromString('2014/05/10');
        SystemClock::set($date);
        $this->assertEquals($date, SystemClock::now());

        SystemClock::reset();
        $this->assertNotEquals($date, SystemClock::now());
    }
}
