<!DOCTYPE html>
<html>
<head>
    <title>Se publico un nuevo servicio</title>
</head>
<body>
    <p>Titulo: {{ $service['title'] }}</p>
    <p>Descripcion: {{ $service['description'] }}</p>
    <br>
    <a href="http://avisosmendoza.com.ar/activar-servicio-mail/{{ $service->id }}/{{ $service->ref }}">Activar</a>
</body>
</html>