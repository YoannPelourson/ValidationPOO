<?php
    class RenderHelperClass
    {   
        /*
        $tag = STRING
        $content = STRING
        $vars = Oprtional ARRAY
        $class = Optional STRING
        */
        static function simpleTag($tag, $content, $vars = false, $class = false)
        {
            if($vars && gettype($vars)=="array"){ 
                foreach ($vars as $key=> $value){
                   $content = str_replace("%$key%", $value, $content);   
                }    
            }
            echo"<$tag class='$class'>$content</$tag>";    
        }

        static function displayTemplate($templateName, $vars = false)
        {
            $temp = "";
            $template = file_get_contents("./views/$templateName.html");
            if($vars){
                foreach($vars as $key => $value){
                    $temp .="<fieldset class= '" . $value->status ."'>";
                    $temp .= "<div >";
                    $temp .= "<ul>";
                    $temp .= "<li><h3>" . $value->status . "</h3></li>";
                    $temp .= "<li>Nom : " . $value->name . "</li>";
                    $temp .= "<li>Classe : " .str_replace("Class","", get_class($value)) . "</li>";
                    $temp .= "<li>HP : " . $value->hp . "</li>";
                    $temp .= "<li>MP : " . $value->mp . "</li>";
                    $temp .= "</ul>";
                    $temp .= "</div>";
                    if($value->status == "hero"){
                        $temp .= "<a href='/index.php?state=fight'>Attack</a>";
                    }
                    $temp .="</fieldset>";
            }
            
               
            }
                $template = str_replace("%fighters%", $temp, $template);   

                

            echo($template);
            
        }
    }