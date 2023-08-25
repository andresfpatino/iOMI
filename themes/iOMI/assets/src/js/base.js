import $ from "jquery";
window.$ = window.jQuery = $;

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

// Get hour in shortcode
function actualizarHora() {
    var fechaHora = new Date();
    var horas = fechaHora.getHours();
    var minutos = fechaHora.getMinutes();
    var segundos = fechaHora.getSeconds();
    
    var amPm = horas >= 12 ? 'pm' : 'am';
    horas = horas % 12 || 12;
    
    // Formatear horas, minutos y segundos con cero inicial si son menores que 10
    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;
    
    document.getElementById("hora-actual").textContent = horas + ":" + minutos + ":" + segundos + " " + amPm;
}
setInterval(actualizarHora, 1000);
actualizarHora();

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