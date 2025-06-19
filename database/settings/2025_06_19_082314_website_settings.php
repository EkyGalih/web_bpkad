<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('website_information.maintenance_mode', false);

        $this->migrator->add('website_information.logo_image', '');
        $this->migrator->add('website_information.email', '');
        $this->migrator->add('website_information.contact_number', '');
        $this->migrator->add('website_information.facebook', '');
        $this->migrator->add('website_information.twitter', '');
        $this->migrator->add('website_information.instagram', '');
        $this->migrator->add('website_information.youtube', '');
        $this->migrator->add('website_information.tiktok', '');
        $this->migrator->add('website_information.subtitle', '');
        $this->migrator->add('website_information.header_image', '');
        $this->migrator->add('website_information.simaskot_qrcode_image', '');
        $this->migrator->add('website_information.simaskot_link', '');
        $this->migrator->add('website_information.simaskot_opd', '');
    }
};
