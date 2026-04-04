<?php

class Autoloader {
    private static array $directories = [
        CONTROLLERS_PATH,
        CORE_PATH,
        MODELS_PATH,
        UTILITIES_PATH
    ];

    public static function register(): void {
        spl_autoload_register(function($class) {
            foreach (self::$directories as $directory) {
                $script = $directory . $class . ".php";

                if (file_exists($script)) {
                    require_once $script;
                    return;
                }
            }
        });
    }
}
