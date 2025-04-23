<div class="row">
    <a class="btn btn-outline-primary mb-2" href="index.php?controller=apuntes&action=editar">Crear Apunte</a>

    <?php
    // Validación robusta de data
    if (!isset($dataToView["data"]) || !is_array($dataToView["data"]) || count($dataToView["data"]) === 0) {
        echo '<div class="alert alert-warning">No hay apuntes registrados aún.</div>';
    } else {
        foreach ($dataToView["data"] as $apunte) {
            $titulo = !empty($apunte["titulo"]) ? $apunte["titulo"] : 'Sin título';
            $contenido = !empty($apunte["contenido"]) ? $apunte["contenido"] : 'Sin contenido';
            $id = isset($apunte["id"]) ? $apunte["id"] : null;
    ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($titulo); ?></h5>
                <p class="card-text text-muted fst-italic"><?php echo nl2br(htmlspecialchars($contenido)); ?></p>
                <?php if ($id): ?>
                    <a href="index.php?controller=apuntes&action=editar&id=<?php echo $id; ?>" class="btn btn-primary">Editar</a>
                    <a href="index.php?controller=apuntes&action=confirmarBorrado&id=<?php echo $id; ?>" class="btn btn-danger">Eliminar</a>
                <?php else: ?>
                    <span class="text-danger">ID no disponible</span>
                <?php endif; ?>
            </div>
        </div>
    <?php
        }
    }
    ?>
</div>
