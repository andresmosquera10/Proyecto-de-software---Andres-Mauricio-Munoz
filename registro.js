document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Obtener valores
    const nombre = form.elements[0].value.trim();
    const usuario = form.elements[1].value.trim();
    const fecha = form.elements[2].value;
    const telefono = form.elements[3].value.trim();
    const correo = form.elements[4].value.trim();
    const contraseña = form.elements[5].value;
    const confirmarContraseña = form.elements[6].value;

    // Validación de nombre y apellido
    const regexNombre = /^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]{1,50}$/;
    if (!regexNombre.test(nombre)) {
      alert("Nombre y apellido inválido. Solo se permiten letras.");
      return;
    }

    // Validación de nombre de usuario
    const regexUsuario = /^[A-Za-z0-9!@#$%^&*()_+\-=~`[\]{}|;:',.<>?/]{8,25}$/;
    const contieneAcentosONie = /[ñÑáéíóúÁÉÍÓÚ]/;
    if (!regexUsuario.test(usuario) || contieneAcentosONie.test(usuario)) {
      alert("Nombre de usuario inválido. Debe tener entre 8 y 25 caracteres, sin acentos ni ñ.");
      return;
    }

    // Validación de la fecha de nacimiento
    const hoy = new Date();
    const fechaNacimiento = new Date(fecha);
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    if (!fecha || fechaNacimiento >= hoy || edad > 120) {
      alert("Fecha de nacimiento inválida.");
      return;
    }

    // Validación del teléfono
    const regexTelefono = /^\d{10}$/;
    if (!regexTelefono.test(telefono)) {
      alert("El número de teléfono debe tener exactamente 10 dígitos.");
      return;
    }

    // Validación del correo
    if (!correo.includes("@")) {
      alert("Correo electrónico inválido.");
      return;
    }

    // Validación de la contraseña
    const regexContrasena = /^[A-Za-z0-9!@#$%^&*()_+\-=~`[\]{}|;:',.<>?/]{8,}$/;
    if (!regexContrasena.test(contraseña) || contieneAcentosONie.test(contraseña)) {
      alert("Contraseña inválida. Debe tener mínimo 8 caracteres, sin acentos ni ñ.");
      return;
    }

    // Validación de la confirmación de contraseña
    if (contraseña !== confirmarContraseña) {
      alert("Las contraseñas no coinciden.");
      return;
    }

    // Si todo está bien
    alert("¡Registro exitoso!");
    // form.submit(); // Lo puedes activar cuando lo conectes al backend
  });
});