<?php

use Cromwell\UKBankHolidays\BankHolidayDay;
use Cromwell\UKBankHolidays\Loader\GovUkLoader;
use PHPUnit\Framework\TestCase;

class GovUkLoaderTest extends TestCase
{
    const NUM_HOLIDAYS = 8;

    public function testLoad()
    {
        $loader = new GovUkLoader(GovUkLoader::SOURCE_CACHE, GovUkLoader::REGION_ENG_WAL, __DIR__ . '/../bank-holidays.json');

        /** @var BankHolidayDay[]|Traversable $holidays */
        $holidays = iterator_to_array($loader->load(2018));

        $this->assertCount(self::NUM_HOLIDAYS, $holidays);

        foreach ($holidays as $holiday) {
            $this->assertInstanceOf(BankHolidayDay::class, $holiday);
        }

        /** @var BankHolidayDay $newYear */
        $newYear = array_shift($holidays);
        $this->assertEquals('2018-01-01', $newYear->date()->format('Y-m-d'));
        $this->assertEquals('New Year’s Day', $newYear->title());
    }
}
