<?php

namespace App\Core;

use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;

abstract class Functions
{
    public  static function arrayHasValue($key, $array): bool
    {
        if(array_key_exists($key, $array)){
            if($array[$key] !== null && $array[$key] !== '') {
                return true;
            }
        }

        return false;
    }

    public  static function hasValue($value): bool
    {
        if(isset($value) && $value !== '') {
            return true;
        }

        return false;
    }

    public  static function getRedirect(Request $request): string
    {
        return match ($request->user()->role) {
            'admin' => RouteServiceProvider::ADMIN_HOME,
            default => RouteServiceProvider::HOME
        };
    }

    public static function uniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}
