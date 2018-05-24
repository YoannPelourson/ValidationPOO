<?php
    
   
    class GameClass
    {
        public $fighters = [];

        function __construct()
        {
            if(isset($_GET['state']) && $_GET['state'] == 'save'){
                
                $this->createFighters($_POST);
            } elseif(isset($_GET['state']) && $_GET['state'] == 'reset'){
                session_destroy();
                header('location: index.php');
            }elseif(isset($_GET['state']) && $_GET['state'] == 'fight'){ 
                
                $fighters = SaveHelperClass::getData('fighters');
                $hero;
                $foe;
                foreach($fighters as $key=> $value){
                    if($value->status == "hero"){
                        $hero = $value;
                    } elseif ($value->status == "foe") {
                        $foe = $value;
                        # code...
                    }
                }
                if(get_class($hero) == "WarriorClass"){
                    $hero->hit($foe);
                }elseif(get_class($hero) == "WizardClass"){
                    $hero->fireball($foe);
                }
                
            }
            if(isset($_SESSION['fighters'])){
                //afficher ecran combat
                RenderHelperClass::displayTemplate('fight',SaveHelperClass::getData('fighters'));
            } else{
                //afficher formulaire
                RenderHelperClass::displayTemplate('form');
            }
        }
        //Instanciate two fighters and add them to the fighters property
        protected function createFighters($fighters)
        { 
            
            foreach($fighters as $key => $value){
                if(gettype($value) == "array");{ 
                $class = ucfirst($value[1]) . 'Class';
                $this->fighters[] = new $class($value[0]);#, $value[2], $value[3]);
                }
            }
            $this->fighters[] = new WarriorClass('grudu', 150, 10,'foe');
            SaveHelperClass::saveData('fighters', $this->fighters);
            
        }

        public function fight()
        {
            RenderHelperClass::simpleTag('h3','The fight is starting');
            while (true) {
                
                $this->fighters[0]->hit($this->fighters[1]);
                RenderHelperClass::simpleTag('p', "%0% frappe %1%", [$this->fighters[0]->name, $this->fighters[1]->name] );
                echo"</br>";
                RenderHelperClass::simpleTag('p', "%0% = %1% hp", [$this->fighters[0]->name, $this->fighters[0]->hp] );
                RenderHelperClass::simpleTag('p', "%0% = %1% hp et %2% mp", [$this->fighters[1]->name, $this->fighters[1]->hp, $this->fighters[1]->mp] );
                echo"===================================================================================";

                if($this->fighters[1]->isDead()){
                    RenderHelperClass::simpleTag('h2', "%1% est mort de la main de  %0%", [$this->fighters[0]->name, $this->fighters[1]->name], "endGame" );
                    break;
                }
                
                if($this->fighters[1]->mp <= 0){
                $this->fighters[1]->fireBall($this->fighters[0]);
                RenderHelperClass::simpleTag('p', "%1% plante sa baguette dans le bras de %0% car il n'a plus de mana", [$this->fighters[0]->name, $this->fighters[1]->name] );
                echo"</br>";
                RenderHelperClass::simpleTag('p', "%0% = %1% hp", [$this->fighters[0]->name, $this->fighters[0]->hp] );
                RenderHelperClass::simpleTag('p', "%0% = %1% hp et %2% mp", [$this->fighters[1]->name, $this->fighters[1]->hp, $this->fighters[1]->mp] );
                echo"===================================================================================";
                }else{
                    $this->fighters[1]->fireBall($this->fighters[0]);
                RenderHelperClass::simpleTag('p', "%1% lance une fireball sur %0% ", [$this->fighters[0]->name, $this->fighters[1]->name] );
                echo"</br>";
                RenderHelperClass::simpleTag('p', "%0% = %1% hp", [$this->fighters[0]->name, $this->fighters[0]->hp] );
                RenderHelperClass::simpleTag('p', "%0% = %1% hp et %2% mp", [$this->fighters[1]->name, $this->fighters[1]->hp, $this->fighters[1]->mp] );
                echo"===================================================================================";
                }
                if($this->fighters[0]->isDead()){
                RenderHelperClass::simpleTag('h2', "%0% est mort de la main de  %1%", [$this->fighters[0]->name, $this->fighters[1]->name],"endGame" );
                    break;
                }
            }
            $this->endGame();
        }
        public function endGame()
        {
            RenderHelperClass::simpleTag('h2', "Fin du combat" );
        }
    }