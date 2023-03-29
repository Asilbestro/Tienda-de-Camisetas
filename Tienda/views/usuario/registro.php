<h1>Registro</h1>



<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'Complete') : ?>

    <strong class="alert_green">Registro completado correctamente</strong>

<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'Failed') : ?>

    <strong class="alert_red">Registro fallido</strong>

<?php endif ?>

<form action="<?= base_url ?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>
    <!-- Show the errors -->
    <?php echo isset($_SESSION['errores']) ? Utils::showErrors($_SESSION['errores'], 'nombre') : ''; ?>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" required>
    <!-- Show the errors -->
    <?php echo isset($_SESSION['errores']) ? Utils::showErrors($_SESSION['errores'], 'apellido') : ''; ?>


    <label for="email">Email</label>
    <input type="email" name="email" required>
    <!-- Show the errors -->
    <?php echo isset($_SESSION['errores']) ? Utils::showErrors($_SESSION['errores'], 'email') : ''; ?>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>
    <!-- Show the errors -->
    <?php echo isset($_SESSION['errores']) ? Utils::showErrors($_SESSION['errores'], 'password') : ''; ?>

    <input type="submit" value="Registrarse">
</form>

<?php
Utils::deleteSession('register');
Utils::deleteSession('errores');
?>