<?php

declare(strict_types=1);

namespace App\Services;

final class SessionService
{
    private const SESSION_NAMESPACE = 'slim_app_session_';

    /**
     * @var array
     */
    private static $sessionData = [];

    public static function set(string $key, $value): bool
    {
        self::$sessionData[self::SESSION_NAMESPACE.$key] = $value;

        return true;
    }

    public static function get(string $key, $defaultValue = null)
    {
        return isset(self::$sessionData[self::SESSION_NAMESPACE.$key])
            ? self::$sessionData[self::SESSION_NAMESPACE.$key]
            : $defaultValue;
    }

    public static function remove(string $key): bool
    {
        unset(self::$sessionData[self::SESSION_NAMESPACE.$key]);

        return true;
    }

    public static function clearAll(): bool
    {
        self::$sessionData = [];

        return true;
    }
}