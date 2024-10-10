<?php
    //Alexis Gil Cabrera 2º DAW
    session_start();
    $nombre = $email = $edad = $pais =  '';
    $existe_pais=0;
    $paises=['España','Inglaterra','Francia','Italia','Irlanda','Ucrania','Alemania'];
    $error_nombre = $error_email =  $error_edad = $error_pais = False;


    $errores = '';
    $puede_continuar = '';
    if(!empty($_POST['paso']))
    {


        if (empty($_POST['nombre']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ningún nombre.<br /></span>";
            $error_nombre = True;
        }
        else if (!preg_match("/^[a-zA-Z]{1,15}$/",$_POST['nombre']))
        {
            $errores .= "<span class=\"error\">¡ERROR! Formato de nombre no válido.<br /></span>";
            $error_nombre = True;
        }

        if (empty($_POST['edad']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha introducido la edad.<br /></span>";
            $error_edad = True;
        }
        else if (!preg_match("/^[1-9]{1}+[0-9]{0,2}$/", $_POST['edad']))
        {
            $errores .= "<span class=\"error\">¡ERROR! Formato de edad no válido.<br /></span>";
            $error_edad = True;
        }

        if (empty($_POST['email']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha introducido ningún E-mail.<br /></span>";
            $error_email = True;
        }
        else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $_POST['email']))
        {
            $errores .= "<span class=\"error\">¡ERROR! Formato de email no válido.<br /></span>";
            $error_email = True;
        }

        foreach ($paises as $pais_seleccionado)
        {
            if ($pais_seleccionado==$_POST['pais'])
            {
                $existe_pais=1;
            }
        }
        if (empty($_POST['pais']))
        {
            $errores .= "<span class=\"error\">¡ERROR! No se ha introducido ningún País.<br /></span>";
            $error_pais = True;
        }
        else if ($existe_pais==0)
        {
            $errores .= "<span class=\"error\">¡ERROR! País no soportado.<br /></span>";
            $error_pais = True;
        }

        if (empty($errores))
        {
            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['edad'] = $_POST['edad'];
            $_SESSION['pais'] = $_POST['pais'];

            $puede_continuar = '<a href="informacion.php">Puede continuar...</a>';
        }
        else
        {
            if ($error_nombre)
                $error_nombre = 'error_nombre';

            if ($error_email)
                $error_email = 'error_email';

            if ($error_edad)
                $error_edad = 'error_edad';

            if ($error_pais)
            $error_pais = 'error_pais';

        }

        $nombre = $_POST['nombre'];
        $email  = $_POST['email'];
        $edad   = $_POST['edad'];
        $pais   = $_POST['pais'];
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de envío</title>
    <style type="text/css">

        .error_nombre, .error_email, .error_edad{

            color:#ff0000;
            font-weight:bold;
        }

        .error, .ok{
            font-weight:bold;
            color:#fff;
        }
        .error{
            background:#ff0000;
        }
        .ok{
            background:#00ff00;
        }

        .campo{
            clear:both;
            padding: 5px 0;
        }

        .campo > label, .campo > input{
            float:left;
        }

        .campo > label{
            width: 70px;
            display:block;

        }


    </style>
</head>
<body>
    <form action="formulario.php" method="POST">
        <input type="hidden" name="paso" value="1" />
        <? echo $errores; ?>

        <div class="campo">
            <label class="<? echo $error_nombre; ?>" for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<? echo $nombre; ?>" placeholder="Nombre de la persona...">
        </div>

        <div class="campo">
            <label class="<? echo $error_email; ?>" for="email">E-mail:</label>
            <input type="text" id="email" name="email" value="<? echo $email; ?>" placeholder="E-mail...">
        </div>
        <div class="campo">
            <label class="<? echo $error_edad; ?>" for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<? echo $edad; ?>" placeholder="Introduce tu edad...">
        </div>
        <div class="campo">
            <label class="<? echo $error_pais; ?>" for="pais">País:</label>
            <input type="text" id="pais" name="pais" value="<? echo $pais; ?>" placeholder="Introduce una País...">
        </div>

        <div class="campo">
            <input type="submit">
        </div>






    </form>

    <?php echo $puede_continuar; ?>
</body>
</html>
