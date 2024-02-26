<?php

namespace Index\php\classes;


class AutoLoading
{

    function __construct()
    {
        $this->register();
    }

    /**
     * Enregistre notre autoloader
     */
    function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            //var_dump($class) ;
            if($class != "AutoLoading") {
                require_once($class . '.php');
            }
        }
    }
}
