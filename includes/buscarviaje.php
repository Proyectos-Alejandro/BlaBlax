<?php 
    require_once '../config/db.php';


    $stmt = $pdo->query("SELECT U.NOMBRE, U.APELLIDO1, U.APELLIDO2, U.FOTO, U.COCHE, BPV.ORIGEN, BPV.DESTINO, BPV.FECHA_HORA, BPV.PLAZAS_TOTALES, BPV.PRECIO, BPV.DESCRIPCION_EXTRA FROM bloque_publicar_viaje BPV INNER JOIN USUARIO U ON U.ID=BPV.CONDUCTOR_ID;");
    $infoviaje = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<div class="filtros_buscar">
    <form action="index.php">
        <input type="text" name="filtro_origen" placeholder="Origen">
        <input type="text" name="filtro_destino" placeholder="Destino">
        <input type="date" name="filtro_fecha">
        <input type="text" name="filtro_plazas" placeholder="Nº de Plazas">
        <button type="submit">Buscar</button>
    </form>
</div>
<div class="filtro_resultado">

    <?php if (count($infoviaje) > 0): ?>
    <div class="contenedor_viajes">
        <?php foreach ($infoviaje as $viaje): ?>
            <div class="viaje">
                <h3>Viaja con <?php echo ($viaje['NOMBRE'] . ' ' . $viaje['APELLIDO1'] . ' ' . $viaje['APELLIDO2']); ?></h3>
                <p>Origen: <?php echo $viaje['ORIGEN']; ?></p>
                <p>Destino: <?php echo $viaje['DESTINO']; ?></p>
                <p>Fecha y hora: <?php echo $viaje['FECHA_HORA']; ?></p>
                <p>Plazas totales: <?php echo $viaje['PLAZAS_TOTALES']; ?></p>
                <p>Precio: <?php echo $viaje['PRECIO']; ?></p>
                <p>Descripción extra: <?php echo $viaje['DESCRIPCION_EXTRA']; ?></p>
                <button type="button">Reservar</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay fotos en la base de datos.</p>
    <?php endif; ?>
    </div>

</div>




















