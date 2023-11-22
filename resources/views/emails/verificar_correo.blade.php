<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $verificar_email->receiver }}, gracias por registrarte en <strong>Supercito Marketplace</strong> !</h2>
    <strong><p>Estos son tus datos de acceso...</p></strong>
    <strong><p>Correo:</p></strong> <p>{{ $verificar_email->email}}</p>
    </strong><p>Password:</p></strong><p>{{ $verificar_email->password}}</p>
    <p>Puedes cambiar tu contraseña cuando quieras en la sección de mi perfil - cambiar contraseña...</p>

</body>
</html>