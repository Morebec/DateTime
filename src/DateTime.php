<?php


namespace Morebec\DateTime;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use DateTime as PHPDateTime;

/**
 * DateTime ACL
 */
class DateTime implements \JsonSerializable
{
    public const DEFAULT_FORMAT = 'Y-m-d H:i:s';

    public const UTC = 'UTC';

    /** @var ChronosInterface */
    private $chronos;

    private function __construct($dateTime)
    {
        if ($dateTime instanceof self) {
            $this->chronos = $dateTime->getRaw();
        } elseif ($dateTime instanceof ChronosInterface) {
            $this->chronos = $dateTime;
        } else {
            $this->chronos = new Chronos($dateTime, self::UTC);
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
     * Adds an hour to the current date time and returns the result
     * @param int $nbHours
     * @return $this
     */
    public function addHour(int $nbHours): self
    {
        return new static($this->chronos->addHour($nbHours));
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
     * Subtracts a number of hours
     * @param int $nbHours
     * @return $this
     */
    public function subtractHours(int $nbHours): self
    {
        return new static($this->chronos->subHours($nbHours));
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

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (string)$this;
    }
}