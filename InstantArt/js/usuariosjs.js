
//al pulsar en un formulario se muestra ese y se ocultan los demas
document.getElementById("clientes").addEventListener("click", function (e) {
    document.getElementById("tabla1").style.display = "block"
    document.getElementById("tabla2").style.display = "none"
    document.getElementById("for4").style.display = "none"
    document.getElementById("for3").style.display = "none"
    document.getElementById("for5").style.display = "none"
    document.getElementById("for6").style.display = "none"
})
//al pulsar en un formulario se muestra ese y se ocultan los demas
document.getElementById("empleados").addEventListener("click", function (e) {
    document.getElementById("tabla2").style.display = "block"
    document.getElementById("tabla1").style.display = "none"
    document.getElementById("for4").style.display = "none"
    document.getElementById("for3").style.display = "none"
    document.getElementById("for5").style.display = "none"
    document.getElementById("for6").style.display = "none"
})

// Agrega un event listener a cada botón de cancelar
document.querySelectorAll(".cancelar").forEach(function (button) {
    button.addEventListener("click", function (e) {
        // Oculta los elementos con los IDs específicos
        document.getElementById("for4").style.display = "none";
        document.getElementById("for3").style.display = "none";
        document.getElementById("for5").style.display = "none";
        document.getElementById("for6").style.display = "none";
    });
});


//al pulsar en un formulario se muestra ese y se ocultan los demas
function Añadir() {
    document.getElementById("for4").style.display = "block"
    document.getElementById("for3").style.display = "none"
    document.getElementById("for5").style.display = "none"
    document.getElementById("for6").style.display = "none"
}

//Al darle a añadir se pilla el id de la fila seleccionada y todos los campos del formulario

function agregarFila1(boton) {
    document.getElementById("for3").style.display = "block"
    document.getElementById("for4").style.display = "none"
    document.getElementById("for5").style.display = "none"
    document.getElementById("for6").style.display = "none"
    var fila = boton.parentNode.parentNode;
    var celdas = fila.getElementsByTagName("td");

    // Almacenar los datos de la fila en variables
    var id = celdas[0].innerText;
    var nombre = celdas[1].innerText;
    var apellido = celdas[2].innerText;
    var contraseña = celdas[3].innerText;
    var email = celdas[4].innerText;
    var fecha = celdas[5].innerText;
    var telefono = celdas[6].innerText;


    document.getElementById("nombre").value = nombre;
    document.getElementById("apellido").value = apellido;
    document.getElementById("fecha").value = fecha;
    document.getElementById("telefono").value = telefono;
    document.getElementById("email").value = email;
    document.getElementById("password").value = contraseña;

    //y se llama a traves de ayax para almacenar en una variable de session el id a actualizar
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.open("POST", "php/almacenar_id_update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id);



}


// Se pilla el id de la fila de la tabla y se llama a una a un fichero con ayax para borrarlo
function eliminarFila1(boton) {
    var fila = boton.parentNode.parentNode;
    var celdas = fila.getElementsByTagName("td");
    var id = celdas[0].innerText;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            fila.remove();

        }
    };
    xhr.open("POST", "php/eliminar_cliente.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id);

}

//Al darle a añadir se pilla el id de la fila seleccionada y todos los campos del formulario
function agregarFila2(boton) {
    document.getElementById("for3").style.display = "none"
    document.getElementById("for4").style.display = "none"
    document.getElementById("for5").style.display = "block"
    document.getElementById("for6").style.display = "none"
    var fila = boton.parentNode.parentNode;
    var celdas = fila.getElementsByTagName("td");

    // Almacenar los datos de la fila en variables
    var id = celdas[0].innerText;
    var nombre = celdas[1].innerText;
    var apellido = celdas[2].innerText;
    var contraseña = celdas[3].innerText;
    var dni = celdas[4].innerText;
    var telefono = celdas[5].innerText;
    var salario = celdas[6].innerText;
    var tipo = celdas[7].innerText;
    console.log(telefono);

    document.getElementById("nombre2").value = nombre;
    document.getElementById("apellido2").value = apellido;
    document.getElementById("dni").value = dni;
    document.getElementById("telefono2").value = telefono;
    document.getElementById("salario").value = salario;
    document.getElementById("tipo").value = tipo;
    document.getElementById("password2").value = contraseña;
    //y se llama a traves de ayax para almacenar en una variable de session el id a actualizar
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.open("POST", "php/almacenar_id_update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id);


}

//se muestra un formulario y se ocultan los demas
function Añadir2() {
    document.getElementById("for4").style.display = "none"
    document.getElementById("for3").style.display = "none"
    document.getElementById("for5").style.display = "none"
    document.getElementById("for6").style.display = "block"
}

// Se pilla el id de la fila de la tabla y se llama a una a un fichero con ayax para borrarlo
function eliminarFila2(boton) {
    var fila = boton.parentNode.parentNode;
    var celdas = fila.getElementsByTagName("td");
    var id = celdas[0].innerText;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            fila.remove();

        }
    };
    xhr.open("POST", "php/eliminar_empleado.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id);

}

var $table = $('#fresh-table')


//esto es un framework que se encarga de hacer tabla dinamicas añadiendo funcionalidades como menus,buscador etc
$(function () {
    $table.bootstrapTable({
        classes: 'table table-hover table-striped',
        toolbar: '.toolbar',
        search: true,
        showPaginationSwitch: true,
        showRefresh: true,
        showToggle: true,
        showColumns: false,
        pagination: true,
        striped: true,
        sortable: true,
        pageSize: 5,
        pageList: [8, 10],

        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de ' + totalRows + ' filas';
        },
        formatRecordsPerPage: function (pageNumber) {
            return ''
        }
    })


})

var $table2 = $('#fresh-table2')

//esto es un framework que se encarga de hacer tabla dinamicas añadiendo funcionalidades como menus,buscador etc
$(function () {
    $table2.bootstrapTable({
        classes: 'table table-hover table-striped',
        toolbar: '.toolbar2',
        search: true,
        showPaginationSwitch: true,
        showRefresh: true,
        showToggle: true,
        showColumns: false,
        pagination: true,
        striped: true,
        sortable: true,
        pageSize: 5,
        pageList: [8, 10],


        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de ' + totalRows + ' filas';
        },
        formatRecordsPerPage: function (pageNumber) {
            return ''
        }
    })


})