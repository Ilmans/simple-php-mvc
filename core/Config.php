<?php
namespace core;

class Config
{
    protected static $config = [];

    /*
     return @void
    */
    public static function loadAll()
    {
        $files = glob('../app/config/*.php');
        foreach ($files as $file) {
            $config = require_once $file;
            $namefile = basename($file,'.php');
            self::$config[$namefile] = $config;
        }
    }

    public static function get($key, $default = null)
    {
      try {
        //code...
        $segments = explode('.', $key);
        $value = self::$config;
     
        if(isset (($value[$segments[0]][$segments[1]]))){
          return $value[$segments[0]][$segments[1]];
        } 
        return $default;
      } catch (\Throwable $th) {
        return $default;
      }
    }
}
?>
