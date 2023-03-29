<h1>Crear nueva Categoria</h1>

<form class="form-container" action="<?= base_url ?>categoria/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>

    <input type="submit" value="Guardar">
</form>