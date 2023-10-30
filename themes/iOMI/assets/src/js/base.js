import $ from "jquery";
window.$ = window.jQuery = $;

import flatpickr from "flatpickr";
import { Spanish } from "flatpickr/dist/l10n/es.js"

// Menu sticky
const header = document.querySelector(".site-header");
const content = document.querySelector(".site-content");
if (header) {
    window.addEventListener("scroll", stickyHeader);
    function stickyHeader() {
        const navbarHeight = header.offsetHeight - 40;
        header.classList.toggle("IsSticky", window.scrollY >= navbarHeight);        
        if (header.classList.contains("IsSticky")) {
            content.style.marginTop = navbarHeight + "px";
        } else {
            content.style.marginTop = "0";
        }
    }
}

// Update date
var inputFecha = document.getElementById("fecha_seleccionada");
var elementoFecha = document.querySelector(".fecha");

if(elementoFecha){
    function formatearFecha(fecha) {
        var fechaUTC = new Date(fecha.getUTCFullYear(), fecha.getUTCMonth(), fecha.getUTCDate(), fecha.getUTCHours(), fecha.getUTCMinutes(), fecha.getUTCSeconds()); 
        var opcionesDeFecha = { weekday: 'long', day: 'numeric', month: 'long' };
        opcionesDeFecha.timeZone = 'America/Bogota';
        return fechaUTC.toLocaleDateString('es-CO', opcionesDeFecha);
    }
    
    elementoFecha.textContent = formatearFecha(new Date(inputFecha.value));
}

// Show extra options in the form
document.addEventListener("DOMContentLoaded", function () {
    var menuRadio = document.getElementsByName("menu");
    var opcionesMenuDia = document.getElementById("opciones-menu-dia");

    for (var i = 0; i < menuRadio.length; i++) {
        menuRadio[i].addEventListener("change", function () {
            if (this.value === "Menú del día") {
                opcionesMenuDia.style.display = "block";
                opcionesMenuDia.style.opacity = 1;

                // Agregar el atributo 'required' a los campos de tipo radio
                var radios = opcionesMenuDia.querySelectorAll('input[type="radio"]');
                for (var j = 0; j < radios.length; j++) {
                    radios[j].setAttribute("required", "required");
                }
            } else {
                opcionesMenuDia.style.display = "none";

                // Remover el atributo 'required' de los campos de tipo radio
                var radios = opcionesMenuDia.querySelectorAll('input[type="radio"]');
                for (var j = 0; j < radios.length; j++) {
                    radios[j].removeAttribute("required");
                }
            }
        });
    }
});


// Calendar
const fechaSeleccionadaInput = document.querySelector("#fecha_seleccionada");

if (fechaSeleccionadaInput) {
    flatpickr(fechaSeleccionadaInput, {
        "locale": Spanish,
        dateFormat: "Y-m-d",
        defaultDate: "today",
        minDate: "today",
        maxDate: new Date().fp_incr(30),
        inline: true,
    });
}