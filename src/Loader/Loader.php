<?php

namespace Cromwell\UKBankHolidays\Loader;

use Cromwell\UKBankHolidays\BankHolidayDay;

abstract class Loader
{
    /**
     * @param int $year
     *
     * @return BankHolidayDay[]|\Traversable
     */
    abstract public function load(int $year);
}
