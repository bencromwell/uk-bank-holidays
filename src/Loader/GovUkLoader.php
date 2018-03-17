<?php

namespace Cromwell\UKBankHolidays\Loader;

use Cromwell\UKBankHolidays\BankHolidayDay;
use DateTime;

class GovUkLoader extends Loader
{
    const REMOTE_URL = 'https://www.gov.uk/bank-holidays.json';

    const SOURCE_REMOTE = 'remote';
    const SOURCE_CACHE = 'cache';

    const REGION_ENG_WAL = 'england-and-wales';
    const REGION_NI = 'northern-ireland';
    const REGION_SCOT = 'scotland';

    /** @var string */
    private $source;

    /** @var string */
    private $region;

    /** @var string */
    private $cacheFile;

    public function __construct(string $source, string $region, ?string $cacheFile = null)
    {
        $this->source = $source;
        $this->region = $region;
        $this->cacheFile = $cacheFile;
    }

    /**
     * @inheritdoc
     */
    public function load(int $year)
    {
        $json = $this->getJson();

        $results = json_decode($json, true);

        foreach ($results[$this->region]['events'] as $result) {
            $date = DateTime::createFromFormat('Y-m-d', $result['date'], new \DateTimeZone('Europe/London'));
            $date->setTime(0, 0, 0);

            if ((int) $date->format('Y') === $year) {
                yield new BankHolidayDay($date, $result['title']);
            }
        }
    }

    private function getJson()
    {
        switch ($this->source) {
            case self::SOURCE_CACHE:
                $source = $this->cacheFile;
            break;
            case self::SOURCE_REMOTE:
            default:
                $source = self::REMOTE_URL;
            break;
        }

        return file_get_contents($source);
    }
}
