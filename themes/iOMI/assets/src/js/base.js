import $ from "jquery";
window.$ = window.jQuery = $;


document.addEventListener("DOMContentLoaded", function () {
    var menuRadio = document.getElementsByName("menu");
    var opcionesMenuDia = document.getElementById("opciones-menu-dia");

    for (var i = 0; i < menuRadio.length; i++) {
        menuRadio[i].addEventListener("change", function () {
            if (this.value === "Menú del día") {
                opcionesMenuDia.style.display = "block";

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