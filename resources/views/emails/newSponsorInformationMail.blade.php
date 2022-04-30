<!DOCTYPE html>
<html>
<head>
    <title>Se destaco el siguiente servicio</title>
</head>
<body>
    <p>Titulo: {{ $service['title'] }}</p>
    <p>Descripcion: {{ $service['description'] }}</p>
    <br>
    <a href="http://avisosmendoza.com.ar/activar-servicio-mail-destacado/{{ $service->id }}/{{ $service->ref }}">Destacar</a>
</body>
</html>