<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Cache::rememberForever('translations', function () {
            $translations = collect();

            foreach (config('language.allowed') as $locale) { // supported locales
                $translations[$locale] = [
                    'json' => $this->jsonTranslations($locale),
                ];
            }

            return $translations;
        });
    }

    private function jsonTranslations($locale)
    {
        $path = resource_path("lang/js/$locale.json");

        return is_string($path) && is_readable($path) ? json_decode(file_get_contents($path), true) : [];
    }
}
