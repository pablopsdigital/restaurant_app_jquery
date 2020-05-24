//Ruta controlador
var url = "../controllers/reservaController.php";

//====================================================================================================================================
//
//====================================================================================================================================
function consultarReservas() {
  $.ajax({
    url: url,
    type: "POST",
    data: { tarea: "consultarReservas" },
    dataType: "json",
  })
    .done(function (res) {
      var html = "";
      $.each(res, function (index, data) {
        html += "<tr>";
        html +=
          "<td>" +
          data.nombre +
          " " +
          data.apellidos +
          "<br>Tel: " +
          data.telefono +
          "</td>";
        html += "<td>" + data.fecha + "</td>";
        html += "<td>" + data.comensales + "</td>";
        html += "<td>";
        html +=
          "<button class='btn btn-danger mx-2 btnAbrirModalEliminar' type='button' data-toggle='modal' onclick='eliminarReserva(" + data.id + ");'><i class='fa fa-trash'></i></button>";
        html +=
          "<button class='btn btn-primary mx-2' type='button' data-toggle='modal' data-target='#modalReserva' onclick='consultarReserva(" + data.id + ");'><i class='fa fa-pencil-square'></i></button>";
        html += "</td>";
        html += "</tr>";
      });

      document.getElementById("datosReservas").innerHTML = html;
      totalReservas();
    })
    .fail(function (res) {
      console.log("ERROR: en metodo consultarReservas: " + res);
    });
}

//====================================================================================================================================
//
//====================================================================================================================================
function consultarReserva(idReserva) {
  $.ajax({
    url: url,
    type: "POST",
    data: {
      id: idReserva,
      tarea: "consultarReserva",
    },
    dataType: "json",
  })
    .done(function (res) {
      document.getElementById("idReserva").value = res.id;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("apellidos").value = res.apellidos;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("fecha").value = res.fecha;
      document.getElementById("hora").value = res.hora;
      $("#comensalesOptions").val(res.comensales);
      //document.getElementById('comensales').value = res.comensales;
      document.getElementById("comentarios").value = res.comentarios;
    })
    .fail(function (res) {
      console.log("ERROR: en metodo consultarReserva: " + res.telefono);
    });
}

//====================================================================================================================================
//
//====================================================================================================================================
function consultarReservas24horas() {
  $.ajax({
    url: url,
    type: "POST",
    data: { tarea: "consultarReservas24horas" },
    dataType: "json",
  })
    .done(function (res) {
      var html = "";
      $.each(res, function (index, data) {
        html += "<tr>";
        html +=
          "<td>" +
          data.nombre +
          " " +
          data.apellidos +
          "<br>Tel: " +
          data.telefono +
          "</td>";
        html += "<td>" + data.fecha + "</td>";
        html += "<td>" + data.comensales + "</td>";
        html += "<td>";
        html +=
          "<button class='btn btn-danger mx-2 btnAbrirModalEliminar' type='button' data-toggle='modal' onclick='eliminarReserva(" + data.id + ");'><i class='fa fa-trash'></i></button>";
        html +=
          "<button class='btn btn-primary mx-2' type='button' data-toggle='modal' data-target='#modalReserva' onclick='consultarReserva(" + data.id + ");'><i class='fa fa-pencil-square'></i></button>";
        html += "</td>";
        html += "</tr>";
      });

      document.getElementById("datosReservas").innerHTML = html;
      totalReservas24horas();
    })
    .fail(function (res) {
      console.log("ERROR: en metodo consultarReservas24horas: " + res.telefono);
    });
}


//====================================================================================================================================
//
//====================================================================================================================================
function consultarNumeroReservas24horas() {
  $.ajax({
    url: url,
    type: "POST",
    data: { tarea: "consultarNumeroReservas24horas" },
    dataType: "json",
  })
    .done(function (res) {
      if(res!= null){
        var numeroRegistros24h=parseInt(res);
        if(numeroRegistros24h > 0){
          totalReservas24horas(numeroRegistros24h);
          $('#tituloReservas24Horas').text('Existen ' + numeroRegistros24h + ' reservas para las próximas 24 horas.')
        }
      }
      console.log(res);



    })
    .fail(function (res) {
      console.log("ERROR: en metodo consultarReservas24horas:" + res);
    });
}





//====================================================================================================================================
//
//====================================================================================================================================
function guardarReserva() {
  var nombre = document.getElementById("nombre").value;
  var apellidos = document.getElementById("apellidos").value;
  var telefono = document.getElementById("telefono").value;
  var fecha = document.getElementById("fecha").value;
  var hora = document.getElementById("hora").value;
  //var comensales = $("#comensalesOptions").children("option:selected").val();
  //var comensales = $("#comensales option:selected").text();
  var comensales = document.getElementById("comensales".value);
  //var comensalesElement = document.getElementById('comensalesOptions');
  //var comensales = comensalesElement.options[comensalesElement.selectedIndex].text;
  var comentarios = document.getElementById("comentarios").value;

  $.ajax({
    url: "../controllers/reservaController.php",
    type: "POST",
    data: {
      nombre: nombre,
      apellidos: apellidos,
      telefono: telefono,
      fecha: fecha,
      hora: hora,
      comensales: comensales,
      comentarios: comentarios,
      tarea: "guardarReserva",
    },
    dataType: "json",
  })
    .done(function (res) {
      if (res == "OK") {
        mostrarAlerta('Nueva reserva creada con éxito.');
        //alert("Los datos de la reserva se han modificado con éxito.");
        limpiarCamposRefrescar();
        $("#modalReserva").modal("toggle");
      } else {
        alert(res);
      }
    })
    .fail(function (res) {
      console.log("ERROR: en metodo guardarReserva: " + res.telefono);
    });
}

//====================================================================================================================================
//
//====================================================================================================================================
function modificarReserva(idReserva) {
  $.ajax({
    url: url,
    data: enviarDatos("modificarReserva"),
    type: "POST",
    dataType: "json",
  })
    .done(function (res) {
      if (res == "OK") {
        //alert("Los datos de la reserva se han modificado con éxito.");
        //limpiarCamposRefrescar();
      } else {
        alert(res);
      }
    })
    .fail(function (res) {
      console.log("ERROR: en metodo modificarReserva: " + res);
    });
}

//====================================================================================================================================
//
//====================================================================================================================================
function eliminarReserva(idReserva) {
  var idBorrar = $(this).data("id-reserva");
  console.log("confirmación: " + idBorrar);

  //Abrimos confirm

  $.ajax({
    url: "../controllers/reservaController.php",
    data: {
      id: idReserva,
      tarea: "eliminarReserva",
    },
    type: "POST",
    dataType: "json",
  })
    .done(function (res) {
      if (res == "OK") {
        //alert("La reserva seleccionada ha sido eliminada correctamente");
        consultarReservas();
      } else {
        console.log(res);
      }
    })
    .fail(function (res) {
      console.log("ERROR: en metodo eliminarReserva: " + res);
    });
}

//====================================================================================================================================
//
//====================================================================================================================================
function enviarDatos(tarea) {
  return {
    id: document.getElementById("idReserva").value,
    nombre: document.getElementById("nombre").value,
    apellidos: document.getElementById("apellidos").value,
    telefono: document.getElementById("telefono").value,
    fecha: document.getElementById("fecha").value,
    hora: document.getElementById("hora").value,
    comensales: document.getElementById("comensales").value,
    comentarios: document.getElementById("comentarios").value,
    tarea: tarea,
  };
}
