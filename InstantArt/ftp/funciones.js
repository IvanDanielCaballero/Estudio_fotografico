
document.getElementById("inicio_sesion").style.display = "none"
document.getElementById("cerrar_sesion").style.display = "block";

//Cargar el nombre del usuario 
document.getElementById('cliente').innerText=nombre;
inicio(id_cliente);

// Llamar a la función cargarFotos cuando se selecciona un evento
document.getElementById("evento2").addEventListener("change", function() {
    let id_evento = document.getElementById('evento2').value;
    cargarFotos('/'+id_cliente+'/'+id_evento);
});

function inicio(id_cliente) {

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


//Carga las fotos del proyecto seleccionado
function cargarFotos(url) {
    const lista = '../gestion/listar_imagenes.php?carpeta=' + url;
    fetch(lista)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const fotosDiv = document.getElementById('fotos');
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
        fetch(`../gestion/borrar_foto.php?image=${encodeURIComponent(fotoUrl)}`, {
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

function obtenerCaminoCompleto(url) {
    // Crear un objeto URL a partir de la cadena de consulta
    const urlObj = new URL(url, window.location.origin);
    // Decodificar el parámetro 'image'
    const imagenRuta = decodeURIComponent(urlObj.searchParams.get('image'));
    return imagenRuta;
}

//Para refescar la galeria cuando borro una foto
function refrescar_fotos(){
    let id_evento = document.getElementById('evento2').value;
    cargarFotos('/'+id_cliente+'/'+id_evento);
};