<?php

namespace Cromwell\UKBankHolidays;

use DateTime;

final class BankHolidayDay
{
    /** @var DateTime */
    private $date;

    /** @var string */
    private $title;

    public function __construct(DateTime $date, string $title)
    {
        $this->date = $date;
        $this->title = $title;
    }

    public function date(): DateTime
    {
        return $this->date;
    }

    public function title(): string
    {
        return $this->title;
    }
}
