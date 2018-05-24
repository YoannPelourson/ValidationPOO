<?php
    class SaveHelperClass
    {
        protected $remoteType = "session";
       static function saveData($key, $value)
        {
            
            $_SESSION[$key] = $value;
            return $_SESSION[$key];
        }
        
            static function getData($key)   
        {
            
            return $_SESSION[$key];
        }

        
    }