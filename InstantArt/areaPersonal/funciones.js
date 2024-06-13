
function MostrarFotos() {
  // Obtiene todos los elementos con la clase "mostrar"
  const fotos = document.getElementsByClassName("mostrar");
  
  // Itera sobre los elementos y cambia su estilo display a "block"
  for (let i = 0; i < fotos.length; i++) {
      fotos[i].style.display = "block";
  }
  
  // Muestra el primer elemento con la clase "see_btn"
  document.getElementsByClassName("see_btn")[0].style.display = "block";
}


// Selecciona todos los elementos con la clase "img-box" dentro de la sección del portafolio
const allImgBoxes = document.querySelectorAll('.portfolio_section .portfolio_container .img-box');
// Convierte la NodeList a un array
const imgBoxes = [...allImgBoxes].slice(0);



// Agrega un evento 'touchstart' a cada elemento "img-box"
imgBoxes.forEach(imgBox => {
  imgBox.addEventListener('touchstart', function() {
      // Selecciona el enlace dentro de la caja de botones del img-box
      const btnLink = imgBox.querySelector('.btn-box a');

      // Verifica el estilo de display del enlace y lo alterna entre visible y oculto
      if (btnLink.style.display === 'none' || btnLink.style.display === '') {
          // Muestra el enlace y lo oculta después de 5 segundos
          btnLink.style.display = 'block';
          setTimeout(function() {
              btnLink.style.display = '';
          }, 5000);
      } else {
          // Oculta el enlace después de 100 milisegundos
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
  // Construye la URL para listar imágenes en la carpeta especificada
  const lista = '../gestion/listar_imagenes.php?carpeta=' + url;
  
  // Realiza una solicitud fetch a la URL construida
  fetch(lista)
      .then(response => response.json()) // Convierte la respuesta a JSON
      .then(data => {
          console.log(data); 
          let i = 1;
          
          // Itera sobre los primeros 6 elementos de los datos recibidos
          for (let j = 0; j < 6; j++) {
              let foto = data[j]; // Obtiene la URL de la foto

              let img = document.getElementById("imagen" + i); // Obtiene el elemento de imagen correspondiente
              img.src = foto; // Establece la URL de la imagen
              img.alt = 'ImagenFTP'; // Establece el texto alternativo de la imagen

              let enlace = document.getElementById("icono" + i); // Obtiene el elemento de enlace correspondiente
              // Asigna una función de clic para descargar la foto
              enlace.onclick = () => descargarFoto(foto);
              i++;
          }
          refrescar_fotos();
      })
      .catch(error => console.error('Error al cargar las fotos:', error)); // Maneja errores en la solicitud
}




//Descargar la foto cuando le das click al icono de descarga
function descargarFoto(fotoUrl) {
  const link = document.createElement('a');
  // Establece la URL de la foto como el atributo href del enlace
  link.href = fotoUrl;
  // Establece el atributo download para sugerir el nombre del archivo descargado
  link.download = 'img';
  // Simula un clic en el enlace para iniciar la descarga
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