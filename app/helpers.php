<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

if (!function_exists('words')) {
    function words($value, $words = 100, $end = "...")
    {
        return Str::limit(strip_tags($value), $words, $end);
    }
}

if (!function_exists('site')) {
    function site($key, $valueDefault = '')
    {

        $value = Setting::getValue($key);

        return $value ?: $valueDefault;
    }
}


if (!function_exists('blog')) {
    function blog()
    {
        return Cache::remember('settings', 60, function () {
            return (object) Setting::pluck('value', 'key')->toArray();
        });
    }
}



if (!function_exists('notFound')) {
    function notFound($view = 'guest.errors.404')
    {
        return response()->view($view, [], 404);
    }
}


if (!function_exists('is_online_internet')) {
    function is_online_internet($site = 'https://www.google.com/')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (curl_exec($ch) !== FALSE) {
            return true;
        }

        return false;
    }
}


if (!function_exists('get_initials')) {
    function get_initials($name)
    {
        $words = explode(" ", $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= Str::substr($word, 0, 1);
        }

        return Str::upper($initials);
    }
}
