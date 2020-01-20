<?php

namespace Morebec\DateTime;

/**
 * The system clock is used to manipulate the clock of the application.
 * Classes should refer to this class to generate times.
 *
 * E.g.:
 * SystemClock::timestamp() -> current timestamp
 * SystemClock::now() -> current date time
 */
class SystemClock
{
    public const UTC = 'UTC';

    /** @var DateTime */
    private static $customDate;

    public static function now():  DateTime
    {
        date_default_timezone_set(self::UTC);
        if(self::$customDate) {
            return self::$customDate;
        }

        return DateTime::fromPHPDateTime(new \DateTime());
    }

    public static function timestamp(): int
    {
        return self::now()->getTimestamp();
    }

    public static function set(DateTime $date)
    {
        self::$customDate = $date;
    }

    public static function reset(): void
    {
        self::$customDate = null;
    }
}
