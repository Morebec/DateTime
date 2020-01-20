<?php

namespace Morebec\DateTime;

use Cake\Chronos\ChronosInterface;
use Cake\Chronos\Date as ChronosDate;
use DateTime as PHPDateTime;

final class Date
{
    public const DEFAULT_FORMAT = 'Y-m-d';

    public const UTC = 'UTC';

    /** @var ChronosDate */
    private $chronos;

    /**
     * Date constructor.
     * @param mixed $date
     */
    private function __construct($date)
    {
        if ($date instanceof self) {
            $this->chronos = $date->getRaw();
        } elseif ($date instanceof ChronosInterface) {
            $this->chronos = $date;
        } else {
            $this->chronos = new ChronosDate($date, self::UTC);
        }
    }

    /**
     * Returns the current date and time
     */
    public static function now(): self
    {
        return self::fromString('now');
    }

    /**
     * Returns today's date at midnight
     * @return static
     */
    public static function today(): self
    {
        return self::fromString('midnight');
    }

    /**
     * Returns yesterdays date at midnight
     * @return static
     */
    public static function yesterday(): self
    {
        return self::fromString('yesterday, midnight');
    }

    /**
     * Returns tomorrow's date at midnight
     * @return static
     */
    public static function tomorrow(): self
    {
        return self::fromString('tomorrow, midnight');
    }

    /**
     * Creates a new instance of DateTime from a formatted string
     * @param string $str
     * @return static
     */
    public static function fromString(string $str): self
    {
        return new static($str);
    }

    /**
     * Creates an instance from a Timestamp
     * @param int $timestamp
     * @return static
     */
    public static function fromTimestamp(int $timestamp): self
    {
        return self::now()->setTimestamp($timestamp);
    }

    /**
     * Creates a new instance of DateTime from a PHPDateTime
     * @param PHPDateTime $dt
     * @return $this
     */
    public static function fromPHPDateTime(PHPDateTime $dt): self
    {
        return self::fromString($dt->format(self::DEFAULT_FORMAT));
    }

    /**
     * Formats a DateTime
     * @param string $format
     * @return string
     */
    public function format(string $format): string
    {
        return $this->chronos->format($format);
    }

    public function __toString()
    {
        return $this->chronos->format(self::DEFAULT_FORMAT);
    }


    /**
     * Adds a number of days to this date
     * @param int $nbDays
     * @return DateTime
     */
    public function addDays(int $nbDays): self
    {
        return new static($this->chronos->addDays($nbDays));
    }

    /**
     * Adds a month
     * @param int $nbMonths
     * @return $this
     */
    public function addMonths(int $nbMonths): self
    {
        return new static($this->chronos->addMonth($nbMonths));
    }

    /**
     * Subtracts a nb of days from this date and returns the result
     * @param int $nbDays
     * @return $this
     */
    public function subtractDays(int $nbDays): self
    {
        return new static($this->chronos->subDays($nbDays));
    }

    /**
     * Subtracts a number of months
     * @param int $nbMonths
     * @return $this
     */
    public function subtractMonths(int $nbMonths): self
    {
        return new static($this->chronos->subMonths($nbMonths));
    }



    /**
     * Returns the raw unwrapped ChronosInterface
     * @return ChronosInterface
     */
    private function getRaw(): ChronosInterface
    {
        return $this->chronos;
    }

    /**
     * Returns  a new instance from a timestamp
     * @param int $timestamp
     * @return $this
     */
    private function setTimestamp(int $timestamp): self
    {
        return new static($this->chronos->timestamp($timestamp));
    }

    /**
     * Returns the timestamp
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->chronos->getTimestamp();
    }
}