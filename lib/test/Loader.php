<?php

namespace test;

class Loader
{
    protected static $_libdir = 'lib';

    public static function init()
    {
        return spl_autoload_register(array(__CLASS__, 'includeClass'));
    }

   public static function includeClass($class)
    {
      //5. Доработайте проект так, чтобы запрос на несуществующую ссылку не приводил к PHP Fatal error;
       $classFile = PROJECTROOT . '/' . self::$_libdir . '/' . strtr($class, '_\\', '//') . '.php';
       if (file_exists($classFile))
          require_once($classFile);
    }
}

function S($class)
{
    $class = __NAMESPACE__ . '\\' . $class;
    return $class::getInstance();
}
