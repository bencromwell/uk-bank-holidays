<?php

namespace Cromwell\UKBankHolidays\Loader;

class LoaderFactory
{
    public function govUkRemote(string $region): Loader
    {
        return new GovUkLoader(GovUkLoader::SOURCE_REMOTE, $region);
    }

    public function govUkCache(string $cacheFile, string $region): Loader
    {
        return new GovUkLoader(GovUkLoader::SOURCE_CACHE, $region, $cacheFile);
    }
}
