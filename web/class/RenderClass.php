<?php

    class RenderClass
    {
        static function renderTemplate($templateName, $info = false)
        {   
            $htmlRender = file_get_contents("./templates/$templateName.html");

            
            
            if($info){
                foreach ($info as $key => $value) {
                    
                    $htmlRender = str_replace("%$key%", $value, $htmlRender);
                }
            }
            
            echo $htmlRender;
        
      }
    }

    