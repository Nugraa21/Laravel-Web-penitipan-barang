<?php

namespace App\Helpers;

class SettingHelper
{
    /**
     * Get setting value, parse json if localized.
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function get_localized($key, $default = '')
    {
        // Settings are preloaded in AppServiceProvider into 'app_settings' config or view share.
        // It's better to fetch from DB or a cache if not available.
        $settings = \Illuminate\Support\Facades\View::shared('app_settings', []);

        if (!array_key_exists($key, $settings)) {
            $setting = \App\Models\Setting::where('key', $key)->first();
            $value = $setting ? $setting->value : $default;
        } else {
            $value = $settings[$key];
        }

        // Check if value is JSON
        if (self::isJson($value)) {
            $decoded = json_decode($value, true);
            $locale = app()->getLocale(); // 'id', 'en', 'ja'

            // Return localized string if exists, otherwise fallback to 'id' then first available, then default
            if (isset($decoded[$locale]) && !empty($decoded[$locale])) {
                return $decoded[$locale];
            } elseif (isset($decoded['id']) && !empty($decoded['id'])) {
                return $decoded['id'];
            } elseif (is_array($decoded) && count($decoded) > 0) {
                return reset($decoded);
            }
        }

        return $value ?: $default;
    }

    private static function isJson($string)
    {
        if (!is_string($string))
            return false;
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
