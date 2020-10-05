<?php

class Session
{

    // public static function init()
    // {
    //     if (version_compare(phpversion(), '5.4.0', '<')) {
    //         if (session_id() == '') {
    //             session_start();
    //         } else {
    //             if (session_status() == PHP_SESSION_NONE) {
    //                 session_start();
    //             }
    //         }
    //     }
    // }

    public static function init()
    {
        session_start();
    }
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
        return true;
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location:login.php");
        }
    }

    public static function checkLogin()
    {
        self::init();
        if (self::get("login") == true) {
            header("Location:index.php");
        }
    }

    public static function destroy()
    {
        session_destroy();
        session_unset();
        header("Location:login.php");
    }
}
