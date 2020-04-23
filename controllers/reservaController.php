<?php

    require '../models/reservaModelo.php';

    //Se recogen los datos en POST
    if($_POST){

        //Se crea una instancia del modelo
        $reserva = new Reserva();

        //Se lee la acción a realizar
        switch($_POST["tarea"]){

            case "consultarReservas":
                echo json_encode($reserva->consultarReservas());
            break;

            case "consultarReserva":
                echo json_encode($reserva->consultarReserva($id));
            break;

            case "consultarReservas24horas";
                echo json_encode($reserva->consultarReservas24horas($id));
            break;

            case "guardarReserva":
                //Leer parametros POST
                $nombre = $_POST["nombre"];
                $apellidos = $_POST["apellidos"];
                $telefono = $_POST["telefono"];
                $fecha = $_POST["fecha"];
                $hora = $_POST["hora"];
                $comensales = $_POST["comensales"];
                $comentarios = $_POST["comentarios"];

                //Se guarda la nueva reserva
                $reserva->guardarReserva($nombre, $apellidos, $telefono, $fecha, $hora, $comensales, $comentarios);
                echo json_encode($respuesta);
            break;

            case "modificarReserva":
                //Leer parametros POST
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $apellidos = $_POST["apellidos"];
                $telefono = $_POST["telefono"];
                $fecha = $_POST["fecha"];
                $hora = $_POST["hora"];
                $comensales = $_POST["comensales"];
                $comentarios = $_POST["comentarios"];

                //Se guarda la nueva reserva
                $reserva->modificarReserva($id, $nombre, $apellidos, $telefono, $fecha, $hora, $comensales, $comentarios);
                echo json_encode($respuesta);
            break;

            case "eliminarReserva":
                echo json_encode($reserva->eliminarReserva($id));
            break;

            
        }
    }