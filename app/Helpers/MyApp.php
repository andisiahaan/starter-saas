<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MyApp
{
    /**
     * Get the logo URL from the settings.
     *
     * @return string|null
     */
     
    public static function getAppUrl(): ?string
    {
        $domain = config('andi.domains.app');
        if (empty($domain)){
            return config("app.url")."/app";
        }
        return "https://".$domain;
    }
    
    public static function getAdminUrl(): ?string
    {
        $domain = config('andi.domains.admin');
        if (empty($domain)){
            return config("app.url")."/admin";
        }
        return "https://".$domain;
    }
    
    public static function getApiUrl(): ?string
    {
        $domain = config('andi.domains.api');
        if (empty($domain)){
            return config("app.url")."/api";
        }
        return "https://".$domain;
    }
    
    public static function getLogoUrl(): ?string
    {   
        $filePath = setting('main.logo');
        if (!$filePath) {
            return "";
        }
        return Storage::disk('public')->url($filePath);
    }

    /**
     * Get the favicon URL from the settings.
     *
     * @return string|null
     */
    public static function getFaviconUrl(): ?string
    {
        $filePath = setting('main.favicon');
        if (!$filePath) {
            return "";
        }
        return Storage::disk('public')->url($filePath);
    }

}
