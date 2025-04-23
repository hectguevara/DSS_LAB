<?php include 'template/encabezado.php'; ?>

<div class="alert alert-warning">
    <h5>¿Confirma que desea eliminar esta nota?</h5>
    
    <form action="index.php?controller=apuntes&action=borrar" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($dataToView['id'] ?? ''); ?>">
        
        <p><strong>Título:</strong> <?php echo htmlspecialchars($dataToView['titulo'] ?? 'Sin título'); ?></p>

        <input type="submit" value="Eliminar" class="btn btn-danger">
        <a href="index.php?controller=apuntes&action=listar" class="btn btn-outline-success">Cancelar</a>
    </form>
</div>

<?php include 'template/piedepagina.php'; ?>
