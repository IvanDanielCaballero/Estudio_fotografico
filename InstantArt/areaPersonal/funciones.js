
function MostrarFotos() {
    const fotos = document.getElementsByClassName("mostrar");
    for (let i = 0; i < fotos.length; i++) {
      fotos[i].style.display = "block";
    }
    document.getElementsByClassName("see_btn")[0].style.display = "block";
  }
  document.getElementById("cliente").innerText = nombre;
  const allImgBoxes = document.querySelectorAll('.portfolio_section .portfolio_container .img-box');
  const imgBoxes = [...allImgBoxes].slice(0);

  imgBoxes.forEach(imgBox => {
    imgBox.addEventListener('touchstart', function() {
      const btnLink = imgBox.querySelector('.btn-box a');

      if (btnLink.style.display === 'none' || btnLink.style.display === '') {
        btnLink.style.display = 'block';
        setTimeout(function() {
          btnLink.style.display = '';
        }, 5000);

      } else {
        setTimeout(function() {
          btnLink.style.display = '';
        }, 100);

      }
    });
  });


  

//Cargar el nombre del usuario 
document.getElementById('cliente').innerText = nombre;
inicio(id_cliente);

// Llamar a la función cargarFotos cuando se selecciona un evento
document.getElementById("evento2").addEventListener("change", function () {
    let id_evento = document.getElementById('evento2').value;
    cargarFotos('/' + id_cliente + '/' + id_evento);
    const fotos = document.getElementsByClassName("mostrar");
    for (let i = 0; i < fotos.length; i++) {
        fotos[i].style.display = "none";
    }
    document.getElementsByClassName("see_btn")[0].style.display = "none";
});

function inicio(id_cliente) {

    // Realizar una solicitud AJAX para obtener los eventos del cliente
    fetch(`get_eventos.php?id_cliente=${id_cliente}`)
        .then(response => response.json())
        .then(data => {
            console.log('Eventos:', data);
            let eventoSelect = document.getElementById("evento2");
            /* eventoSelect.innerHTML = ''; */
            data.forEach(evento => {
                let option = document.createElement("option");
                option.value = evento.id_evento;
                option.text = evento.evento;
                console.log(evento.evento);
                eventoSelect.add(option);
            });
            //añadido por jose carlos si no hay ningun evento añade una opcion diciendo que no hay eventos
            if (eventoSelect.childElementCount == 0) {
                var option = document.createElement('option');
                option.text = 'No tienes eventos contratados';
                eventoSelect.appendChild(option);
                document.getElementById("servicios").style.display="block"
            } else {
                document.getElementById("imagenes").style.display = "block"
            }

            if (data.length > 0) {
                eventoSelect.selectedIndex = 0;
                eventoSelect.dispatchEvent(new Event('change'));
            }
        })
        .catch(error => console.error('Error:', error));
}




function cargarFotos(url) {
    const lista = '../gestion/listar_imagenes.php?carpeta=' + url;
    fetch(lista)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let i = 1;
            for (let j = 0; j < 6; j++) {
                let foto = data[j];

                let img = document.getElementById("imagen" + i);
                img.src = foto;
                img.alt = 'ImagenFTP';

                let enlace = document.getElementById("icono" + i);
                enlace.onclick = () => descargarFoto(foto);

                i++;
            }
            refrescar_fotos()
        })
        .catch(error => console.error('Error al cargar las fotos:', error));
}



function descargarFoto(fotoUrl) {
    const link = document.createElement('a');
    link.href = fotoUrl;
    link.download = 'img';
    link.click();
}


//Almacenamos el id del evento
function refrescar_fotos() {
    let id_evento = document.getElementById('evento2').value;
    /* cargarFotos('/' + id_cliente + '/' + id_evento); */

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);

        }
    };
    xhr.open("POST", "almacenar_evento.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id_evento=" + id_evento);

};