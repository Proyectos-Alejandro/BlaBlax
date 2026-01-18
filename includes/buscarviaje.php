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



    <?php 
        $filtro_origen = $_GET['filtro_origen'] ?? '';
        $filtro_destino = $_GET['filtro_destino'] ?? '';
        $filtro_fecha = $_GET['filtro_fecha'] ?? '';
        $filtro_plazas = $_GET['filtro_plazas'] ?? '';

        $filtro_texto = "SELECT U.NOMBRE, U.APELLIDO1, U.APELLIDO2, U.FOTO, U.COCHE, BPV.ORIGEN, BPV.DESTINO, BPV.FECHA_HORA, BPV.PLAZAS_TOTALES, BPV.PRECIO, BPV.DESCRIPCION_EXTRA FROM bloque_publicar_viaje BPV INNER JOIN USUARIO U ON U.ID=BPV.CONDUCTOR_ID WHERE 1=1";

        if (!empty($filtro_origen)) {
            $filtro_texto .= " AND BPV.ORIGEN LIKE :origen";
        }
        if (!empty($filtro_destino)) {
            $filtro_texto .= " AND BPV.DESTINO LIKE :destino";
        }
        if (!empty($filtro_fecha)) {
            $filtro_texto .= " AND DATE(BPV.FECHA_HORA) = fecha";
        }
        if (!empty($filtro_plazas)) {
            $filtro_texto .= " AND BPV.PLAZAS_TOTALES >= :plazas";
        }

        $stmt = $pdo->prepare($filtro_texto);
        if (!empty($filtro_origen)) {
            $stmt->bindValue(':origen', '%' . $filtro_origen . '%');
        }
        if (!empty($filtro_destino)) {
            $stmt->bindValue(':destino', '%' . $filtro_destino . '%');
        }
        if (!empty($filtro_fecha)) {
            $stmt->bindValue(':fecha', $filtro_fecha);
        }
        if (!empty($filtro_plazas)) {
            $stmt->bindValue(':plazas', (int)$filtro_plazas);
        }

        $stmt->execute();
        $infoviaje = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

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
        <p>No hay viajes disponibles con estos filtros, se el primero en publicar uno</p>
    <?php endif; ?>
    </div>

</div>




















