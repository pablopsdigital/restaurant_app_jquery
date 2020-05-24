<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    require '../models/reservaModel.php';

    $reserva = new Reserva();


    /*
    $listadoReservas = $reserva->consultarReservas();
    foreach ($listadoReservas as $item){
        echo("<p>".$item->nombre."</p>");
    }
    */

    //$reserva->guardarReserva('manolo', 'fernandez gondar', '987654364','2021-04-02','10:00:00', 3 ,'asdfasdfas');
    //$reserva->modificarReserva( 25, 'EstaModificado', 'ffff gondar', '987654364','2020-04-02','10:00:00', 3 ,'asdfasdfas');
    //$reserva->eliminarReserva(22);

    // echo '<pre>';
    // print_r($reserva->consultarReserva(1));
    // echo '</pre>';

    //consultarReservas24horas
    // $listadoReservas = $reserva->consultarReservas24horas();
    // foreach ($listadoReservas as $item){
    //     echo("<p> 24HORAS: ".$item->nombre. "- ". $item->fecha."</p>");
    // }

    $listadoReservas = $reserva->consultarNumeroReservas24horas();
    echo json_decode($listadoReservas);
    




?>
    
</body>
</html>