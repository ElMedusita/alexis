<?php
    session_start();
    echo "<p>Nombre: " . $_SESSION['nombre'] . "</p>";
    echo "<p>Edad: " . $_SESSION['edad'] . "</p>";
    echo "<p>Email: " . $_SESSION['email'] . "</p>";
    echo "<p>País: " . $_SESSION['pais'] . "</p>";
?>