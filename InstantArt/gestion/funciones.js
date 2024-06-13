

//Añadir proyectos
function Anadir(id_cliente){
    document.getElementById('id_cliente').value = id_cliente;
    document.getElementById("forAnadir").style.display = "block";
    document.getElementById('forSubir').style.display = 'none';
    document.getElementById("forEditar").style.display = "none";
}

function Subir(id_cliente) {
    document.getElementById('id_cliente_img2').value = id_cliente;
    document.getElementById('forSubir').style.display = 'block';
    document.getElementById("forAnadir").style.display = "none";
    document.getElementById("forEditar").style.display = "none";

    //Borro las fotos por si han pulsado repetidamente a gestionar imagenes
    console.log('hola');
    const fotosDiv = document.getElementById('fotos2');
    fotosDiv.innerHTML = ''

    // Solicitud Ajax para obtener el nombre del cliente
    fetch(`get_cliente.php?id_cliente=${id_cliente}`)
        .then(response => response.json())
        .then(data => {
            // Establecer el nombre del cliente en el h4
            document.getElementById("nombre_cliente").innerText = data;
        })
        .catch(error => console.error('Error:', error));

    // Realizar una solicitud AJAX para obtener los eventos del cliente
    fetch(`get_eventos.php?id_cliente=${id_cliente}`)
        .then(response => response.json())
        .then(data => {
            console.log('Eventos:', data);
            let eventoSelect = document.getElementById("evento2");
            eventoSelect.innerHTML = '';
            data.forEach(evento => {
                let option = document.createElement("option");
                option.value = evento.id_evento;
                option.text = evento.evento;
                eventoSelect.add(option);
            });
                if (data.length > 0) {
                eventoSelect.selectedIndex = 0;
                eventoSelect.dispatchEvent(new Event('change'));
            }
        })
        .catch(error => console.error('Error:', error));
}



//Editar proyectos
function Modificar(id_cliente) {
    document.getElementById('id_cliente_img2').value = id_cliente;
    document.getElementById('forSubir').style.display = 'none';
    document.getElementById("forAnadir").style.display = "none";
    document.getElementById("forEditar").style.display = "block";

    // Solicitud Ajax para obtener el nombre del cliente
    fetch(`get_cliente.php?id_cliente=${id_cliente}`)
        .then(response => response.json())
        .then(data => {
            // Establecer el nombre del cliente en el h4
            document.getElementById("nombre_cliente").innerText = data;
        })
        .catch(error => console.error('Error:', error));

    // Realizar una solicitud AJAX para obtener los eventos del cliente
    fetch(`get_eventos.php?id_cliente=${id_cliente}`)
        .then(response => response.json())
        .then(data => {
            console.log('Eventos:', data);
            let eventoSelect = document.getElementById("evento");
            eventoSelect.innerHTML = '';
            data.forEach(evento => {
                let option = document.createElement("option");
                option.value = evento.id_evento;
                option.text = evento.evento;
                eventoSelect.add(option);
            });
            
        })
        .catch(error => console.error('Error:', error));
}



//Opciones para la edicion de las imagenes en los eventos

function subirImagen() {
    // Obtener el formulario y los datos necesarios
    let form = document.getElementById('formularioSubirImagen');
    let formData = new FormData(form);
    let id_cliente = document.getElementById('id_cliente_img2').value;
    let id_evento = document.getElementById('evento2').value;

    // Agregar los datos adicionales al formData
    formData.append('id_cliente', id_cliente);
    formData.append('id_evento', id_evento);

    // Crear y configurar la solicitud AJAX
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'subirImagen.php', true);

    // Definir el evento onload
    xhr.onload = function() {
        if (xhr.status === 200) {
            // La solicitud fue exitosa
            console.log('Imagen subida correctamente');
            refrescar_fotos();
        } else {
            // Hubo un error en la subida de la imagen
            console.error('Error al subir la imagen:', xhr.statusText);
        }
    };

    // Enviar la solicitud AJAX con los datos del formulario
    xhr.send(formData);
}

document.getElementById('formularioSubirImagen').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe
    subirImagen();
});


//Cargar las fotos desde el ftp y ademas se añaden botones con funcionalidades
function cargarFotos(url) {
    const lista = 'listar_imagenes.php?carpeta=' + url;
    fetch(lista)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const fotosDiv = document.getElementById('fotos2');
            fotosDiv.innerHTML = ''; // Limpiar las fotos antes de agregar nuevas
            data.forEach(foto => {
                const fotoContainer = document.createElement('div');
                fotoContainer.style = 'display: inline-block; margin: 10px; text-align: center;';

                const img = document.createElement('img');
                img.src = foto;
                img.alt = 'ImagenFTP';
                img.style = 'margin: 10px; width: 150px; height: auto; display: block;';

                const downloadButton = document.createElement('button');
                downloadButton.textContent = 'Descargar';
                downloadButton.style = 'margin-top: 5px;';
                console.log(foto);
                downloadButton.onclick = () => descargarFoto(foto);

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Borrar';
                deleteButton.style = 'margin-top: 5px; margin-left: 5px;';
                deleteButton.onclick = () => borrarFoto(foto);

                fotoContainer.appendChild(img);
                fotoContainer.appendChild(downloadButton);
                fotoContainer.appendChild(deleteButton);

                fotosDiv.appendChild(fotoContainer);
            });
        })
        .catch(error => console.error('Error al cargar las fotos:', error));
}


function descargarFoto(fotoUrl) {
    const link = document.createElement('a');
    link.href = fotoUrl;
    link.download = 'img';
    link.click();
}


// Función para borrar una foto
function borrarFoto(fotoUrl) {
    console.log(fotoUrl);
    fotoUrl= obtenerCaminoCompleto(fotoUrl);
    console.log(fotoUrl);
        // Realizar solicitud para borrar la foto del servidor
        fetch(`borrar_foto.php?image=${encodeURIComponent(fotoUrl)}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refrescar_fotos();
            } else {
                alert('Error al borrar la foto');
            }
        })
        .catch(refrescar_fotos());
}



// Llamar a la función cargarFotos cuando se selecciona un evento
document.getElementById("evento2").addEventListener("change", function() {
    let id_evento = this.value;
    let id_cliente= document.getElementById('id_cliente_img2').value;
    cargarFotos('/'+id_cliente+'/'+id_evento);
});

function refrescar_fotos(){
        let id_evento = document.getElementById('evento2').value;
        let id_cliente= document.getElementById('id_cliente_img2').value;
        cargarFotos('/'+id_cliente+'/'+id_evento);
    };


function obtenerCaminoCompleto(url) {
    // Crear un objeto URL a partir de la cadena de consulta
    const urlObj = new URL(url, window.location.origin);
    // Decodificar el parámetro 'image'
    const imagenRuta = decodeURIComponent(urlObj.searchParams.get('image'));
    return imagenRuta;
}


function borrarEvento() {
    let evento = document.getElementById('evento').value;
    let id_cliente = document.getElementById('id_cliente_img2').value;

    // Crear y configurar la solicitud AJAX
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'borrar_evento.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Evento borrado correctamente');
            location.reload();
        } else {
            console.error('Error al borrar el evento:', xhr.statusText);
        }
    };

    // Enviar la solicitud con los datos necesarios
    xhr.send(`id_cliente=${encodeURIComponent(id_cliente)}&evento=${encodeURIComponent(evento)}`);
}




//CSS de las tablas



var $table = $('#fresh-table')


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