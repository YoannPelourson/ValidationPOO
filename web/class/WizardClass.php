<?php
    

    class WizardClass extends AdventurerClass
    {
        function __construct($name, $hp = 100, $mp = 50, $status = false)
        {
            parent::__construct($name, $status);
            $this->hp=$hp;
            $this->mp=$mp;
        }
        public function fireBall($enemy)
        {

            if(isset($enemy) && is_subclass_of($enemy, 'AdventurerClass')){
                $crit = rand(1, 10);
                $usedMP = 10;
                if($this->mp - $usedMP >=0) { 
                    if($crit >=9){
                        $this->setMP($this->mp -$usedMP);
                        echo"</br>paf la pasteque";
                $dmg = 30;
                $enemy->receiveDamage($dmg);
                    }    
                $this->setMP($this->mp -$usedMP);
                $dmg = rand(10, 25);
                $enemy->receiveDamage($dmg);
                
                } else{
                $dmg = 1 ;
                $enemy->receiveDamage($dmg);
                }
            }
        }
        
    }