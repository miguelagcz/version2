// CÓDIGO DEL MENÚ HAMBURGUESA
let lastScrollTop = 0;
const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  let scrollTop = window.scrollY || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // scroll hacia abajo
    header.classList.add("headerOculto");
  } else {
    // scroll hacia arriba
    header.classList.remove("headerOculto");
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});

// TESTIMONIOS
const testimonios = document.querySelectorAll(".testimonial-carousel-container .testimonial");
let indice = 0;

function mostrarTestimonio(i) {
  testimonios.forEach((el, idx) => {
    el.classList.toggle("active", idx === i);
  });
}

// Mostrar el primer testimonio al cargar
mostrarTestimonio(indice);

// Cambiar testimonio cada 5 segundos
setInterval(() => {
  indice = (indice + 1) % testimonios.length;
  mostrarTestimonio(indice);
}, 5000);

// FORMULARIO MULTIPASO
let paso = 0;
const totalPasos = 12; // Pantallas de 0 a 11 (12 en total)

// Presupuesto que lleva a la pantalla de "este servicio no es para ti"
const PRESUPUESTO_DESCALIFICA = "presu1";
const PASO_PRESUPUESTO = 6;

// Configuración de botones
function configurarBoton(campoId, botonId, esCheckbox = false, esRadio = false) {
  const campo = esCheckbox || esRadio 
    ? document.querySelectorAll(`input[name="${campoId}"]`)
    : document.getElementById(campoId);
  const boton = document.getElementById(botonId);

  if ((campo || (esCheckbox && campo)) && boton) {
    if (esCheckbox || esRadio) {
      // Para checkboxes y radios
      campo.forEach(elemento => {
        elemento.addEventListener("change", function() {
          const algunoSeleccionado = esCheckbox
            ? document.querySelectorAll(`input[name="${campoId}"]:checked`).length > 0
            : document.querySelector(`input[name="${campoId}"]:checked`) !== null;
          
          boton.classList.toggle("inactivo", !algunoSeleccionado);
          boton.classList.remove("error");
        });
      });
    } else {
      // Para inputs normales y selects
      campo.addEventListener("input", function() {
        const valor = this.value.trim();
        if (valor === "") {
          boton.classList.add("inactivo");
          boton.classList.remove("error");
        } else {
          boton.classList.remove("inactivo");
          boton.classList.remove("error");
        }
      });
      
      // Validación inicial para selects
      if (campo.tagName === 'SELECT') {
        campo.addEventListener("change", function() {
          if (this.value !== "") {
            boton.classList.remove("inactivo");
            boton.classList.remove("error");
          }
        });
      }
    }
  }
}

// Inicializa todos los botones al cargar la página
document.addEventListener("DOMContentLoaded", function() {
  // Campos de texto/email
  configurarBoton("nombre", "btn-nombre");
  configurarBoton("correo", "btn-correo");
  configurarBoton("vendes", "btn-vendes");
  configurarBoton("web", "btn-web");
  
  // Selects
  configurarBoton("pais", "btn-pais");
  configurarBoton("presupuesto", "btn-presupuesto");
  configurarBoton("ingreso", "btn-ingresos");

  // País: campo "Otro" y cambio de moneda (MXN / USD)
  configurarPais();

  // Lada: campo editable en la pantalla final
  configurarLada();
  
  // Checkboxes (marketing)
  configurarBoton("marketing[]", "btn-marketing", true);
  
  // Radios (empezar)
  configurarBoton("empezar", "btn-empezar", false, true);
  
  // Radios (llamada puntual)
  configurarBoton("opcion", "btn-llamada", false, true);
  
  // Limitar caracteres en "¿Qué vendes?"
  document.getElementById("vendes")?.addEventListener("input", function() {
    const maxLength = 1000;
    if (this.value.length > maxLength) {
      this.value = this.value.substring(0, maxLength);
    }
  });
});

// PAÍS Y MONEDA
// México = pesos (data-mxn); Estados Unidos u Otro = dólares (data-usd)
function actualizarMoneda() {
  const pais = document.getElementById("pais")?.value;
  const moneda = pais === "mexico" ? "mxn" : "usd";

  document.querySelectorAll("#presupuesto option[data-mxn], #ingreso option[data-mxn]").forEach(opcion => {
    opcion.textContent = opcion.dataset[moneda];
  });

  const campoMoneda = document.getElementById("moneda");
  if (campoMoneda) campoMoneda.value = moneda.toUpperCase();
}

function configurarPais() {
  const select = document.getElementById("pais");
  const inputOtro = document.getElementById("paisOtro");
  const boton = document.getElementById("btn-pais");
  if (!select || !inputOtro || !boton) return;

  function actualizarBotonPais() {
    const incompleto = select.value === "" || (select.value === "Otro" && inputOtro.value.trim() === "");
    boton.classList.toggle("inactivo", incompleto);
  }

  select.addEventListener("change", function () {
    const esOtro = this.value === "Otro";
    inputOtro.hidden = !esOtro;
    if (esOtro) {
      inputOtro.focus();
    } else {
      inputOtro.value = "";
    }
    actualizarMoneda();
    actualizarBotonPais();
  });

  inputOtro.addEventListener("input", function () {
    boton.classList.remove("error");
    document.getElementById("error-pais").textContent = "";
    actualizarBotonPais();
  });
}

// LADA (pantalla final): campo editable que sugiere +52 y +1
function configurarLada() {
  const lada = document.getElementById("codigoPais");
  if (!lada) return;

  lada.addEventListener("input", function () {
    this.dataset.tocado = "1"; // ya no se autocompleta con el país
    document.getElementById("error-final").textContent = "";
  });

  // Si escriben solo números (ej. 57), se agrega el "+"
  lada.addEventListener("blur", function () {
    const valor = this.value.trim();
    if (/^\d{1,4}$/.test(valor)) this.value = "+" + valor;
  });
}

// PANTALLA DE DESCALIFICACIÓN
function mostrarDescalificado() {
  const pantalla = document.getElementById("descalificado");
  if (!pantalla) return;

  window.scrollTo(0, 0);
  header.classList.remove("headerOculto");
  document.querySelector(".barra-contenedor").style.display = "none";
  const flechaAtras = document.querySelector(".flecha-atras");
  if (flechaAtras) flechaAtras.style.display = "none";

  pantalla.hidden = false;
  document.body.style.overflow = "hidden";

  // Evento para Google Tag Manager (útil para excluir estos leads de las conversiones)
  window.dataLayer = window.dataLayer || [];
  window.dataLayer.push({ event: "agenda_descalificado" });
}

// Función auxiliar para mostrar errores
function mostrarError(elementoError, mensaje, boton) {
  const errorElement = document.getElementById(elementoError);
  if (errorElement) errorElement.textContent = mensaje;

  if (boton) {
    boton.classList.remove("inactivo");
    boton.classList.add("error");
    boton.disabled = true; // Bloquea el botón
    setTimeout(() => {
      boton.classList.remove("error");
      boton.disabled = false; // Lo habilita después de la animación
      if (!boton.disabled) boton.classList.add("inactivo");
    }, 500); // 500ms igual que la animación shake
  }
}

function validarCampo() {
  let valido = true;
  document.querySelectorAll(".error").forEach(e => e.textContent = "");

  // Obtener el botón "Siguiente" actual
  const botonActual = document.querySelector(`.pantalla:nth-child(${paso + 1}) .btn-siguiente`);

  // Validaciones para cada paso
  if (paso === 1) { // Nombre
    const nombre = document.getElementById("nombre").value.trim();
    if (nombre === "") {
      mostrarError("error-nombre", "Por favor ingresa tu nombre.", botonActual);
      valido = false;
    }
  }

  if (paso === 2) { // Correo
    const correo = document.getElementById("correo").value.trim();
    if (correo === "") {
      mostrarError("error-correo", "Por favor ingresa tu correo.", botonActual);
      valido = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
      mostrarError("error-correo", "Correo electrónico inválido.", botonActual);
      valido = false;
    }
  }

  if (paso === 3) { // ¿Qué vendes?
    const vendes = document.getElementById("vendes").value.trim();
    if (vendes === "") {
      mostrarError("error-vendes", "Por favor indica qué vendes.", botonActual);
      valido = false;
    }
  }

  if (paso === 4) { // País
    const pais = document.getElementById("pais").value;
    if (!pais) {
      mostrarError("error-pais", "Por favor selecciona un país.", botonActual);
      valido = false;
    } else if (pais === "Otro" && document.getElementById("paisOtro").value.trim() === "") {
      mostrarError("error-pais", "Por favor escribe el país de tu negocio.", botonActual);
      valido = false;
    }
  }

  if (paso === 5) { // Marketing (checkboxes)
    const checkedMarketing = document.querySelectorAll('input[name="marketing[]"]:checked').length;
    if (checkedMarketing === 0) {
      mostrarError("error-marketing", "Selecciona al menos una opción.", botonActual);
      valido = false;
    }
  }

  if (paso === 6) { // Presupuesto
    const presupuesto = document.getElementById("presupuesto").value;
    if (!presupuesto) {
      mostrarError("error-presupuesto", "Selecciona un presupuesto.", botonActual);
      valido = false;
    }
  }

  if (paso === 7) { // Página web
    const web = document.getElementById("web").value.trim();
    if (web === "") {
      mostrarError("error-web", "Por favor ingresa tu página web o escribe 'No tengo'.", botonActual);
      valido = false;
    }
  }

  if (paso === 8) { // Ingresos mensuales
    const ingreso = document.getElementById("ingreso").value;
    if (!ingreso) {
      mostrarError("error-ingreso", "Selecciona un rango de ingresos.", botonActual);
      valido = false;
    }
  }

  if (paso === 9) { // ¿Cuándo empezar? (radios)
    const radiosEmpezar = document.querySelectorAll('input[name="empezar"]:checked').length;
    if (radiosEmpezar === 0) {
      mostrarError("error-empezar", "Selecciona una opción.", botonActual);
      valido = false;
    }
  }

  if (paso === 10) { // Llamada puntual (radios)
    const radiosLlamada = document.querySelectorAll('input[name="opcion"]:checked').length;
    if (radiosLlamada === 0) {
      mostrarError("error-llamada", "Por favor selecciona una opción.", botonActual);
      valido = false;
    }
  }

  if (paso === 11) { // Diapositiva 12: Validar formulario final
  let validoFinal = true;
  const nombreFinal = document.getElementById("nombreFinal").value.trim();
  const apellido = document.getElementById("apellido").value.trim();
  const telefono = document.getElementById("telefono").value.trim();
  const empresa = document.getElementById("empresa").value.trim();
  const webFinal = document.getElementById("webFinal").value.trim();

  if (nombreFinal === "" || apellido === "" || telefono === "" || empresa === "" || webFinal === "") {
    mostrarError("error-final", "Por favor completa todos los campos obligatorios.", document.getElementById("btn-enviar"));
    validoFinal = false;
  } else if (!/^\+?\d{1,4}$/.test(document.getElementById("codigoPais").value.trim())) {
    mostrarError("error-final", "Escribe la lada de tu país, por ejemplo +52.", document.getElementById("btn-enviar"));
    validoFinal = false;
  }

  valido = valido && validoFinal;
}

  return valido;
}

// Funcionalidad del formulario multipaso
document.querySelectorAll('h2').forEach(h2 => {
  h2.dataset.original = h2.innerHTML;
});

function siguientePaso() {
  if (!validarCampo()) return;
  // Presupuesto mínimo: mostrar pantalla de "este servicio no es para ti"
  if (paso === PASO_PRESUPUESTO && document.getElementById("presupuesto").value === PRESUPUESTO_DESCALIFICA) {
    mostrarDescalificado();
    return;
  }
  if (paso < totalPasos - 1) paso++;
  actualizarVista();
}

function pasoAnterior() {
  if (paso > 0) paso--;
  actualizarVista();
}

function actualizarVista() {
  const flechaAtras = document.querySelector(".flecha-atras");
  if (flechaAtras) {
    if (paso === 0) {
      flechaAtras.style.display = "none";
    } else {
      flechaAtras.style.display = "block";
    }
  }
  const formulario = document.querySelector(".formulario");
  formulario.style.transform = `translateX(-${paso * 100}vw)`;

  const nombre = document.getElementById("nombre")?.value.trim() || "[Nombre]";

  // Actualizar nombre dinámico en h2
  if ([2, 7, 9, 10].includes(paso)) {
    document.querySelectorAll('h2').forEach(h2 => {
      h2.innerHTML = h2.dataset.original.replace(/\[Nombre\]/g, nombre);
    });
  }

  // Autocompletar solo nombre y página web en la última pantalla
  if (paso === totalPasos - 1) {
    // Lada sugerida según el país elegido (solo si no la han escrito a mano)
    const codigoPais = document.getElementById("codigoPais");
    if (codigoPais && !codigoPais.dataset.tocado) {
      const pais = document.getElementById("pais").value;
      codigoPais.value = pais === "mexico" ? "+52" : pais === "estadosUnidos" ? "+1" : "";
    }

    const nombreFinal = document.getElementById("nombreFinal");
    const webFinal = document.getElementById("webFinal");
    const nombreOriginal = document.getElementById("nombre");
    const webOriginal = document.getElementById("web");
    
    if (nombreFinal && nombreOriginal) {
      nombreFinal.value = nombreOriginal.value || "";
    }
    
    if (webFinal && webOriginal) {
      webFinal.value = webOriginal.value || "";
    }
  }

  // Actualizar barra de progreso
  const barra = document.getElementById("barraAzul");
  const bolita = document.getElementById("bolita");
  const porcentaje = Math.min((paso / (totalPasos - 1)) * 100, 100);
  barra.style.width = `${porcentaje}%`;
  bolita.style.right = `calc(${100 - porcentaje}% - 10px)`;
}

// El envío al webhook de Make y la redirección final están en un <script> dentro de agenda.html

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="marketing[]"]');
    const ninguno = Array.from(checkboxes).find(cb => cb.value === 'seo' && cb.nextElementSibling.textContent.includes('Ninguno'));

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (ninguno.checked) {
                checkboxes.forEach(other => {
                    if (other !== ninguno) {
                        other.disabled = true;
                        other.parentElement.classList.add('disabled');
                    }
                });
            } else {
                checkboxes.forEach(other => {
                    if (other !== ninguno) {
                        other.disabled = false;
                        other.parentElement.classList.remove('disabled');
                    }
                });
            }

            // Si cualquier otro está seleccionado, deshabilita "Ninguno"
            const anyOtherChecked = Array.from(checkboxes).some(other => other !== ninguno && other.checked);
            if (anyOtherChecked) {
                ninguno.disabled = true;
                ninguno.parentElement.classList.add('disabled');
            } else {
                ninguno.disabled = false;
                ninguno.parentElement.classList.remove('disabled');
            }
        });
    });
});

// Inicializar vista
actualizarVista();