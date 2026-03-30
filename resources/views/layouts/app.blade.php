<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tasks App</title>
</head>
<body>

<h1>Tasks App</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@yield('content')

</body>
</html>