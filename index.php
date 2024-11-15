<?php
$db = new PDO('sqlite:/var/www/html/funciones.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $stmt = $db->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

$stmt = $db->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Web PHP con SQLite</title>
</head>
<body>
    <h1>Insertar Usuario</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Insertar">
    </form>

    <h1>Lista de Usuarios</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nombre']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><a href="?eliminar=<?php echo $usuario['id']; ?>">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
