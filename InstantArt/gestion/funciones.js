

//Añadir proyectos
function Anadir(id_cliente){
    document.getElementById('id_cliente').value = id_cliente;
    document.getElementById("forAnadir").style.display = "block";
    document.getElementById('forSubir').style.display = 'none';
    
};

function Subir(id_cliente) {
    document.getElementById('id_cliente_img').value = id_cliente;
    document.getElementById('forSubir').style.display = 'block';
    document.getElementById("forAnadir").style.display = "none";

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
