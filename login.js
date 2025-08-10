document.addEventListener('DOMContentLoaded', function () {
  // Manejo del formulario de inicio de sesión
  const form = document.getElementById('login-form');

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const userInput = document.getElementById('user-input').value.trim();
      const passwordInput = document.getElementById('password-input').value.trim();

      if (userInput === '') {
        alert('Por favor, ingresa tu usuario, correo o número de teléfono.');
        return;
      }

      if (passwordInput.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
      }

      // Aquí podrías enviar el formulario si todo es válido
      // Por ejemplo, usar fetch o redirigir
      form.submit();
    });
  }

  // Manejo del botón "Crear una cuenta"
  const botonCrearCuenta = document.querySelector('.create-account');
  if (botonCrearCuenta) {
    botonCrearCuenta.addEventListener('click', function () {
      window.location.href = 'registro.html';
    });
  }
});