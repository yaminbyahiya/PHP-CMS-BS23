<?php
    class Car{
        public $wheels = 4;
        static $doors = 4;
        public $hood = 1;
        public $engine = 1;
        private $speed = 50;
        
        function __construct(){
            echo $this->speed;
            echo "<br>";
        }

        function increaseSpeed(){
            $this->speed = 70;
            echo $this->speed;
        }
        function decreaseSpeed(){
            $this->speed = 40;
            echo $this->speed;
        }
        static function makeConvertible(){
            Car::$doors = 2;
        }
    }
    class Jet extends Car{
        function showSpeed(){
            echo $this->speed;
        }
    }
    $bmw = new Car();
    $plane = new Jet();
    echo $plane->wheels;
    echo "<br>";
    echo $bmw->hood;
    echo "<br>";
    echo $bmw->engine;
    echo "<br>";
    $bmw->increaseSpeed();
    echo "<br>";
    Car::makeConvertible();
    echo Car::$doors;
    $plane->showSpeed();
?>