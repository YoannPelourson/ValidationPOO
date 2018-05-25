<?php

 class RoutingClass
 {
     static function route()
     {
         if(isset($_GET['action'])){
            session_destroy();
            header('location: index.php');
         } else{ 
         if(isset($_POST['user'])){
             
             $_SESSION['user'] = $_POST['user'];
             header('Location: /index.php');
             
         }else{ 
        if(isset($_POST['id'])){
            
            RenderClass::renderTemplate('Header', $_SESSION['user']);
            RenderClass::renderTemplate('article'. $_POST['id']);
            RenderClass::renderTemplate('footer');
        }else{ 
         if(isset($_SESSION['user']) && gettype($_SESSION['user']) == "array"){
             RenderClass::renderTemplate('Header', $_SESSION['user']);
             RenderMultiClass::multiTemplate(['article1','article2']);
             //RenderClass::renderTemplate('article2');
             RenderClass::renderTemplate('footer');
         }
         else{
             RenderClass::renderTemplate('form');
         }
         
        }
       }
      }
     }
 }
