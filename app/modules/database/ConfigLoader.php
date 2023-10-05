<?php

namespace App\modules\database;

use App\Paths;

final class ConfigLoader
{

    public static function loadDatabaseConfig()
    {
        $configFilePath = Paths::DATABASE_CONFIG_FILE_PATH;
        return require $configFilePath;
    }
    public static function loadSMTPConfig()
    {
        $configFilePath = Paths::SMTP_CONFIG_FILE_PATH;
        return require $configFilePath;
    }
}


