<?php
session_start();

if (!isset($_SESSION['nombreApellido'])) {
    header("Location: index.php");
    exit();
}

$nombreApellido = $_SESSION['nombreApellido'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En búsqueda de la ambrosía</title>
    <link rel="stylesheet" href="menuprincipal.css?v=<?php echo time(); ?>">

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>
</head>

<body>

    <div class="background-image">

        <div class="top-bar">
            <a href="perfil.php">Perfil</a>
            <a href="restaurante.php">Restaurante</a>
        </div>

        <div class="welcome-bar">
            <span>Hola, <?php echo htmlspecialchars($nombreApellido); ?></span>
            <a href="logout.php" class="logout">Cerrar sesión</a>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Buscar restaurantes...">
            <button>Buscar</button>
            <button>Filtros</button>
        </div>

        <div id="map"></div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const map = L.map("map").setView([4.711, -74.0721], 13);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            map.locate({
                setView: true,
                maxZoom: 16
            });

            function onLocationFound(e) {
                const radius = e.accuaracy / 2;

                L.marker(e.latlng)
                    .addTo(map)
                    .bindPopup("Estás aquí 📍")
                    .openPopup();

                L.circle(e.latlng, radius).addTo(map);
            }

            function onLocationError(e) {
                alert("No se pudo acceder a tu ubicación: " + e.message);

                map.setView([4.711, -74.0721], 13);
                L.marker([4.711, -74.0721])
                    .addTo(map)
                    .bindPopup("Ubicación predeterminada: Bogotá, Colombia")
                    .openPopup();
            }

            map.on("locationfound", onLocationFound);
            map.on("locationerror", onLocationError);
        });
    </script>

</body>

</html>