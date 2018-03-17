<?php

use Cromwell\UKBankHolidays\Loader\GovUkLoader;
use Cromwell\UKBankHolidays\Loader\Loader;
use Cromwell\UKBankHolidays\Loader\LoaderFactory;
use PHPUnit\Framework\TestCase;

class LoaderFactoryTest extends TestCase
{
    /** @var LoaderFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new LoaderFactory();
    }

    public function testLoadRemote()
    {
        $this->assertInstanceOf(Loader::class, $this->factory->govUkRemote(GovUkLoader::REGION_ENG_WAL));
        $this->assertInstanceOf(Loader::class, $this->factory->govUkRemote(GovUkLoader::REGION_NI));
        $this->assertInstanceOf(Loader::class, $this->factory->govUkRemote(GovUkLoader::REGION_SCOT));
    }

    public function testLoadCache()
    {
        $cacheFile = __DIR__ . '/../bank-holidays.json';
        $this->assertInstanceOf(Loader::class, $this->factory->govUkCache($cacheFile, GovUkLoader::REGION_ENG_WAL));
        $this->assertInstanceOf(Loader::class, $this->factory->govUkCache($cacheFile, GovUkLoader::REGION_NI));
        $this->assertInstanceOf(Loader::class, $this->factory->govUkCache($cacheFile, GovUkLoader::REGION_SCOT));
    }
}
