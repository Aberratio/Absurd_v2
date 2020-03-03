<?php
    class Configuration{    

        private static $config = array();    

        public static function set($name, $value) {        
            self::$config[$name]=$value;    
        }    

        public static function get($name) {        
            return self::$config[$name];   
         }    

        public static function exist($name) {        
            return isset(self::$config[$name]);    
        }
    }

    Configuration::set("theme", "dark");
    Configuration::set("language", "pl");
?>


