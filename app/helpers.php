<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


/**
 * @return mixed
 */
function getRandomBackground()
{
    $files = Storage::disk('public')->allFiles('img/backgrounds/' . env('BACKGROUND_MODE', 'default'));

    return URL::secure(Arr::random($files));
}

/** Returns all the available countries that have translatable files
 * @return array
 */
function getAvailableTranslations()
{
    return [
        "English" => [
            'flag' => 'united-states',
            'code' => 'us'
        ],
        "Portuguese" => [
            'flag' => 'brazil',
            'code' => 'br'
        ],
        "Chinese" => [
            'flag' => 'china',
            'code' => 'cn'
        ],
        "German" => [
            'flag' => 'germany',
            'code' => 'de'
        ],
        "Spanish" => [
            'flag' => 'spain',
            'code' => 'es'
        ],
        "French" => [
            'flag' => 'france',
            'code' => 'fr'
        ],
        "Italian" => [
            'flag' => 'italy',
            'code' => 'it'
        ],
        "Japanese" => [
            'flag' => 'japan',
            'code' => 'jp'
        ],
        "Korean" => [
            'flag' => 'korea',
            'code' => 'ko'
        ],
        "Mexican" => [
            'flag' => 'mexico',
            'code' => 'mx'
        ],
        "Polish" => [
            'flag' => 'poland',
            'code' => 'pl'
        ],
        "Russian" => [
            'flag' => 'russia',
            'code' => 'ru'
        ],
        "Taiwanese" => [
            'flag' => 'taiwan',
            'code' => 'tw'
        ]
    ];
}

/** Returns specific info based upon locale code
 * @param $local_code
 * @return array|null
 */
function getLocaleInfo($local_code)
{
    $localeArray = getAvailableTranslations();

    foreach ($localeArray as $country => $option) {
        if ($option['code'] === $local_code) {
            return [$country => $option];
        }
    }
    return null;
}
