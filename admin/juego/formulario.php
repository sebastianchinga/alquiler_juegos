<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" placeholder="Título del videojuego" name="juego[titulo]" value="<?php echo $juego->titulo ?>">
</div>
<div class="form-group">
    <label for="imagen">Imágen</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagen" name="juego[imagen]">
            <label class="custom-file-label" for="exampleInputFile">Elije una imágen</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Subir</span>
        </div>
    </div>
</div>
<?php if ($juego->imagen): ?>
    <img src="/imagenes/<?php echo $juego->imagen ?>" alt="Imágen" style="width: 20rem;">
<?php endif; ?>
<div class="form-group">
    <label for="plataforma">Plataforma</label>
    <input type="text" class="form-control" id="plataforma" placeholder="Plataforma" name="juego[plataforma]" value="<?php echo $juego->plataforma ?>">
</div>
<div class="form-group">
    <label class="d-block">Disponibilidad:</label>
    <div class="icheck-primary d-inline mr-3">
        <input <?php echo $juego->disponible === "1" ? 'checked' : '' ?> type="radio" id="disponible" name="juego[disponible]" value="1" checked>
        <label for="disponible">
            Disponible
        </label>
    </div>
    <div class="icheck-primary d-inline">
        <input <?php echo $juego->disponible === "0" ? 'checked' : '' ?> type="radio" id="alquilado" name="juego[disponible]" value="0">
        <label for="alquilado">
            Alquilado
        </label>
    </div>
</div>
<div class="form-group">
    <label>Género:</label>
    <select class="form-control select2" style="width: 100%;" name="juego[generos_id]">
        <option value="">--Selecciona un género--</option>
        <?php foreach ($generos as $genero): ?>
            <option <?php echo $genero->id === $juego->generos_id ? 'selected' : '' ?> value="<?php echo $genero->id ?>"><?php echo $genero->nombre ?></option>
        <?php endforeach; ?>
    </select>
</div>