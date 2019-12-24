<?php
/**
 *Session Class
 **/
class Session
{
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
                return true;
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                return true;
            }
        }
        return false;
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("adminlogin") == false) {
            self::destroy();
            header("Location:login.php");
            return false;
        }
        return true;
    }

    public static function checkLogin()
    {
        self::init();
        if (self::get("adminlogin") == true) {
            header("Location:dashboard.php");
        }
    }

    public static function destroy()
    {
        session_destroy();
        header("Location:login.php");
        return true;
    }
}
