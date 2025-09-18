document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    const nombre = form.elements["nombreApellido"].value.trim();
    const usuario = form.elements["nombreUsuario"].value.trim();
    const fecha = form.elements["fechaNacimiento"].value;
    const telefono = form.elements["telefono"].value.trim();
    const correo = form.elements["correo"].value.trim();
    const contraseña = form.elements["contrasena"].value;
    const confirmarContraseña = form.elements["confirmarContrasena"].value;

    const regexNombre = /^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]{1,50}$/;
    if (!regexNombre.test(nombre)) {
      alert("Nombre y apellido inválido. Solo se permiten letras.");
      e.preventDefault();
      return;
    }

    const regexUsuario = /^[A-Za-z0-9!@#$%^&*()_+\-=~`[\]{}|;:',.<>?/]{8,25}$/;
    const contieneAcentosONie = /[ñÑáéíóúÁÉÍÓÚ]/;
    if (!regexUsuario.test(usuario) || contieneAcentosONie.test(usuario)) {
      alert("Nombre de usuario inválido. Debe tener entre 8 y 25 caracteres, sin acentos ni ñ.");
      e.preventDefault();
      return;
    }

    const hoy = new Date();
    const fechaNacimiento = new Date(fecha);
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    if (!fecha || fechaNacimiento >= hoy || edad > 120) {
      alert("Fecha de nacimiento inválida.");
      e.preventDefault();
      return;
    }

    const regexTelefono = /^\d{10}$/;
    if (!regexTelefono.test(telefono)) {
      alert("El número de teléfono debe tener exactamente 10 dígitos.");
      e.preventDefault();
      return;
    }

    if (!correo.includes("@")) {
      alert("Correo electrónico inválido.");
      e.preventDefault();
      return;
    }

    const regexContrasena = /^[A-Za-z0-9!@#$%^&*()_+\-=~`[\]{}|;:',.<>?/]{8,}$/;
    if (!regexContrasena.test(contraseña) || contieneAcentosONie.test(contraseña)) {
      alert("Contraseña inválida. Debe tener mínimo 8 caracteres, sin acentos ni ñ.");
      e.preventDefault();
      return;
    }

    if (contraseña !== confirmarContraseña) {
      alert("Las contraseñas no coinciden.");
      e.preventDefault();
      return;
    }
  });
});