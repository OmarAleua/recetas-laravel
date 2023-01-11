<?php include 'includes/header.php';

class MenuRestaurant
{
    public $nombre = "";
    public $precio = 0;
}

$bebida = new MenuRestaurant();
$bebida->nombre = "Jugo de Naraja";
$bebida->precio = 30;
var_dump($bebida);

$postre = new MenuRestaurant();
$postre->nombre = "Lemon Pie";
$postre->precio = 100;
var_dump($postre);
