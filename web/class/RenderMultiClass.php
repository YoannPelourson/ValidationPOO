

<?php
    
    class RenderMultiClass 
    {

        static function multiTemplate($templateName)
        {
        
            $htmlRender = "" ;   
            foreach($templateName as $value){
                
                $htmlRender .= RenderClass::renderTemplate($value);
                    
                }
                echo $htmlRender;
            } 
            
        }

           

        