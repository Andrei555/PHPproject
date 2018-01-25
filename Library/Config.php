<?php

namespace Library;

class Config
{
    public function __construct()
    {
        $file = CONFIG_DIR . 'db.xml';
        $xmlObject = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOWARNING);

        if (!$xmlObject) {
            throw new \Exception('Config file not found');
        }

        foreach ($xmlObject as  $key => $value) {
            $this->$key = (string)$value;
        }
    }

//    public static function get($key)
//    {
//        if(isset(self::$items[$key])){
//            return self::$items[$key];
//        }
//        return null;
//    }
//    public static function set($key, $value)
//    {
//        self::$items[$key] = $value;
//    }
}