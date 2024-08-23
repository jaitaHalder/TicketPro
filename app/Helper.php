<?php

namespace App;

use Closure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Helper
{
    public const LENGTH_UNIT = 'km';
    public const CURRENCY = 'BDT';
    public const COPYRIGHT = 'Copyright &copy; 2024 by Jaita Haldar';

    /**
     * @param string|null $timestamp
     * @return string
     */
    public static function convertTime(?string $timestamp): string
    {
        return $timestamp ? date('h:i A', strtotime($timestamp)) : '-';
    }

    /**
     * @param string $date
     * @return string
     */
    public static function convertBookingDate(string $date): string
    {
        return date('l d F Y', strtotime($date));
    }

    /**
     * @param string $timestamp
     * @return string
     */
    public static function convertDateTime(string $timestamp): string
    {
        return date('l d F Y h:i A', strtotime($timestamp));
    }

    /**
     * @param $name
     * @param $default
     * @return mixed
     */
    public static function setting($name, $default = null): mixed
    {
        $settings = app('settings');
        return $settings[$name] ?? $default;
    }

    /**
     * @return array
     */
    public static function settings(): array
    {
        return app('settings');
    }
}