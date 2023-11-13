<?php
    print_r($_POST);

    // Verifica si el campo 'id_cliente' está presente y es un número
    if (!isset($_POST['id_cliente']) || !is_numeric($_POST['id_cliente'])) {
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';

    // Recoge los valores del formulario
    $id_cliente = $_POST['id_cliente'];
    $nombre_completo = $_POST["nombre_completo"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $contrasena = $_POST["contrasena"];
    $puntos_acumulados = $_POST["puntos_acumulados"];
    $genero = $_POST["genero"];

    // Asegúrate de que tus columnas y valores coincidan en el orden correcto
    $sentencia = $bd->prepare("UPDATE tbl_cliente SET nombre_completo = ?, correo = ?, telefono = ?, direccion = ?, fecha_nacimiento = ?, contrasena = ?, puntos_acumulados = ?, genero = ? WHERE id_cliente = ?");
    
    // Ejecuta la sentencia preparada
    $resultado = $sentencia->execute([$nombre_completo, $correo, $telefono, $direccion, $fecha_nacimiento, $contrasena, $puntos_acumulados, $genero, $id_cliente]);

    // Verifica el resultado y redirige según sea necesario
    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
?>
