<?php

namespace App\Observers;

use App\Models\Config;
use Illuminate\Support\Facades\Cache;

class ConfigObserver
{
    public function created(Config $config)
    {
        Cache::put($config->key, $config->value);
    }

    public function saved(Config $config)
    {
        Cache::put($config->key, $config->value);
    }

    public function deleted(Config $config)
    {
        Cache::forget($config->key);
    }
}
