<?php

require 'conexion.php';

class Persona
{

    private $id;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $fecha;
    private $hora;
    private $comensales;
    private $comentarios;

    //====================================================================================================================================
    // Función para almacenar una nueva reserva en la base de datos
    //====================================================================================================================================
    public function guardarReserva($nombre, $apellidos, $telefono, $fecha, $hora, $comensales, $comentarios)
    {

        //Formato requerido 2020-04-02 14:40:00
        $fechaHora = new DateTime($fecha->format('Y-m-d') . ' ' . $hora->format('H:i:s'));

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("INSERT INTO 'reservas'('nombre', 'apellidos', 'telefono', 'fecha', 'comensales', 'comentarios')
            VALUES(:nombre, :apellidos, :fecha, :comensales, :comentarios);");

        //Se pasan los parametros a la consulta
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $statement->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $statement->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $statement->bindParam(':fecha', $fechaHora, PDO::PARAM_STR);           //Se pasa la fecha y hora
        $statement->bindParam(':comensales', $comensales, PDO::PARAM_INT);
        $statement->bindParam(':comentarios', $comentarios, PDO::PARAM_STR);

        //Se ejecuta la consulta
        if ($statement->execute()) {
            return 'OK';
        } else {
            return 'Error: Se ha producido un error al actualizar la reserva';
        }
    }

    //====================================================================================================================================
    // Función para editar una reserva en la base de datos
    //====================================================================================================================================
    public function modificarReserva($id, $nombre, $apellidos, $telefono, $fecha, $hora, $comensales, $comentarios)
    {

        //Formato requerido 2020-04-02 14:40:00
        $fechaHora = new DateTime($fecha->format('Y-m-d') . ' ' . $hora->format('H:i:s'));

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("UPDATE 'reservas'
                                        SET   'nombre' = :nombre, 
                                              'apellidos'=:apellidos,
                                              'telefono'=:telefono,
                                              'fecha'=:fecha,
                                              'comensales'=:comensales,
                                              'comentarios'=:comentarios
                                        WHERE 'id'=:id;");

        //Se pasan los parametros a la consulta
        $statement->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $statement->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
        $statement->bindValue(':telefono', $telefono, PDO::PARAM_STR);
        $statement->bindValue(':fecha', $fechaHora, PDO::PARAM_STR);
        $statement->bindValue(':comensales', $comensales, PDO::PARAM_INT);
        $statement->bindValue(':comentarios', $comentarios, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        //Se ejecuta la consulta
        if ($statement->execute()) {
            return 'OK';
        } else {
            return 'Error: Se ha producido un error al eliminar la reserva';
        }
    }

    //====================================================================================================================================
    // Función para eliminar una reserva en la base de datos
    //====================================================================================================================================
    public function eliminarReserva($id)
    {

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("DELETE FROM 'reservas' WHERE 'id'=:id");

        //Se pasan los parametros a la consulta
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        //Se ejecuta la consulta
        if ($statement->execute()) {
            return 'OK';
        } else {
            return 'Error: no se ha podido almacenar la reserva';
        }
    }

    //====================================================================================================================================
    // Función para consultar el listado de reservas completo
    //====================================================================================================================================
    public function consultarReservas()
    {

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("SELECT * FROM 'reservas'");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    //====================================================================================================================================
    // Función para consultar el listado de reservas completo
    //====================================================================================================================================
    public function consultarReservas24horas()
    {

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("SELECT * FROM 'reservas' WHERE fecha > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    //====================================================================================================================================
    //Función para consultar los datos de una reserva concreta
    //====================================================================================================================================
    public function consultarReserva($id)
    {

        //Crear la conexion
        $conexion = new Conexion();
        $statement = $conexion->prepare("SELECT * FROM 'reservas' WHERE 'id'=:id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }

}