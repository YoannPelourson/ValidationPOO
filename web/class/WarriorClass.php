<?php
    

    class WarriorClass extends AdventurerClass  
    {
        function __construct($name, $hp = 150, $mp = 10, $status = false)
        {
            parent::__construct($name, $status);
            $this->hp=$hp;
            $this->mp=$mp;
        }
        public function hit($enemy)
        {
            if(isset($enemy) && is_subclass_of($enemy,'AdventurerClass')){
                $crit = rand(1, 10);
                if($crit >= 8){
                echo'</br>paf la pasteque';
                $dmg = 15;
                $enemy->receiveDamage($dmg);
                }else{ 
                $dmg = rand(5, 10);
                $enemy->receiveDamage($dmg);
                }
            }
        }
    }