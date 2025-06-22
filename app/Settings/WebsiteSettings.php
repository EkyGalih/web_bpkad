<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class WebsiteSettings extends Settings
{
    public bool $maintenance_mode = false;
    public string $logo_image = '';
    public string $email = '';
    public string $contact_number = '';
    public string $facebook = '';
    public string $twitter = '';
    public string $instagram = '';
    public string $youtube = '';
    public string $tiktok = '';
    public string $title = '';
    public string $subtitle = '';
    public string $header_image = '';
    public string $simaskot_qrcode_image = '';
    public string $simaskot_link = '';
    public string $simaskot_opd = '';

    public static function group(): string
    {
        return 'website_information';
    }
}
