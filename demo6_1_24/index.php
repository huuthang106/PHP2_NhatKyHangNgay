<?php
class MyRectangle
{
    public $x, $y;
    function newArea($a, $b)
    {
        return $a * $b;
    }
    function getArea(){
        return $this->newArea( $this->x, $this->y);
    }
}
$r = new MyRectangle();
$r->x=5;
$r->y=10;

echo $r->getArea();
?>