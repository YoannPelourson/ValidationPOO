<?php
    abstract class AdventurerClass
    {
        //properties
        public $name;
        public $hp;
        public $mp;
        public $status = "hero";
        

        function __construct($name, $status)
        {
            $this->name = $name;
            if($status){
                $this->status = $status;
            }
        }
        protected function receiveDamage($dmg)
        {
            if(isset($this->hp) && gettype($this->hp)== 'integer'){
                $this->hp = $this->hp - $dmg;
                return $this->hp;
            }
            
        }
        public function isDead()
        {
            if($this->hp < 1) {
                return true;
            } else {
                return false;
            }
        }
        protected function setMP($mp)
        { 
        return $this->mp = $mp;
        }
        
    }