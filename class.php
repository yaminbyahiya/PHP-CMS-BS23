<?php
    class Car{
        var $wheels = 4;
        var $doors = 4;
        var $hood = 1;
        var $engine = 1;
        var $speed = 50;

        function increaseSpeed(){
            $this->speed = 70;
            echo $this->speed;
        }
        function decreaseSpeed(){
            $this->speed = 40;
            echo $this->speed;
        }
        function makeConvertible(){
            $this->doors = 2;
            echo $this->doors;
        }
    }
    $bmw = new Car();
    echo $bmw->hood;
    echo "<br>";
    echo $bmw->engine;
    echo "<br>";
    $bmw->increaseSpeed();
    echo "<br>";
    $bmw->makeConvertible();
?>