<?php 
    require_once '../config/db.php';


    $stmt = $pdo->query("SELECT U.NOMBRE, U.APELLIDO1, U.APELLIDO2, U.COCHE, U.FOTO, C1.PAIS AS PAIS_ORIGEN,C1.PROVINCIA AS PROVINCIA_ORIGEN,C1.MUNICIPIO AS MUNICIPIO_ORIGEN,C1.CP AS CP_ORIGEN, C2.PAIS AS PAIS_DESTINO, C2.PROVINCIA AS PROVINCIA_DESTINO,C2.MUNICIPIO AS MUNICIPIO_DESTINO,C2.CP AS CP_DESTINO, V.FECHA_HORA, V.PLAZAS_TOTALES, V.PRECIO, V.DESCRIPCION_EXTRA FROM VIAJES V INNER JOIN USUARIO U ON U.ID = V.CONDUCTOR_ID INNER JOIN CIUDADES C1 ON C1.ID = V.ID_ORIGEN INNER JOIN CIUDADES C2 ON C2.ID = V.ID_DESTINO;");
    $infoviaje = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $opcionesviaje = $pdo->query("SELECT ID, PAIS, PROVINCIA, MUNICIPIO, CP FROM CIUDADES WHERE PAIS COLLATE utf8mb4_unicode_ci LIKE '%%' AND PROVINCIA COLLATE utf8mb4_unicode_ci LIKE '%%' AND MUNICIPIO COLLATE utf8mb4_unicode_ci LIKE '%%' AND CP COLLATE utf8mb4_unicode_ci LIKE '%%';");
    $viajes = $opcionesviaje->fetchAll(PDO::FETCH_ASSOC);

    $opcionesviaje_pais = $pdo->query("SELECT DISTINCT PAIS FROM CIUDADES WHERE PAIS COLLATE utf8mb4_unicode_ci LIKE '%%';");
    $viajes_pais = $opcionesviaje_pais->fetchAll(PDO::FETCH_ASSOC);

    $opcionesviaje_provincia = $pdo->query("SELECT DISTINCT PROVINCIA FROM CIUDADES WHERE PROVINCIA COLLATE utf8mb4_unicode_ci LIKE '%%';");
    $viajes_provincia = $opcionesviaje_provincia->fetchAll(PDO::FETCH_ASSOC);

    $opcionesviaje_municipio = $pdo->query("SELECT DISTINCT MUNICIPIO FROM CIUDADES WHERE MUNICIPIO COLLATE utf8mb4_unicode_ci LIKE '%%';");
    $viajes_municipio = $opcionesviaje_municipio->fetchAll(PDO::FETCH_ASSOC);

    $opcionesviaje_cp = $pdo->query("SELECT DISTINCT CP FROM CIUDADES WHERE CP COLLATE utf8mb4_unicode_ci LIKE '%%';");
    $viajes_cp = $opcionesviaje_cp->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="filtros_buscar">

    <form action="index.php"> <!-- FORMULARIO PARA BUSCAR VIAJES -->
        <fieldset class="fieldset_buscar">
            <legend>BUSCA TU VIAJE</legend>

                <?php if (count($viajes_pais) > 0): ?> <div class="contenedor_origen_pais"> <!-- FILTRO ORIGEN PAIS -->
                        <input list="filtro_origen_pais" name="filtro_origen_pais" placeholder="PAIS ORIGEN">
                        <datalist id="filtro_origen_pais"> <?php foreach ($viajes_pais as $viaje_pais): ?>
                                <option value="<?php echo $viaje_pais['PAIS']; ?>">
                            <?php endforeach; ?>
                        </datalist>  
                    </div>
                <?php else: ?>
                    <div class="contenedor_origen_pais">
                            <input list="filtro_origen_pais" name="filtro_origen_pais" placeholder="PAIS ORIGEN">
                            <datalist id="filtro_origen_pais">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->
  
                <?php if (count($viajes_provincia) > 0): ?> <div class="contenedor_origen"> <!-- FILTRO ORIGEN PROVINCIA -->
                        <input list="filtro_origen_provincia" name="filtro_origen_provincia" placeholder="PROVINCIA ORIGEN">
                        <datalist id="filtro_origen_provincia"> <?php foreach ($viajes_provincia as $viaje_provincia): ?>
                                <option value="<?php echo $viaje_provincia['PROVINCIA']; ?>">
                            <?php endforeach; ?>
                        </datalist>  
                    </div>
                <?php else: ?>
                    <div class="contenedor_origen">
                            <input list="filtro_origen_provincia" name="filtro_origen_provincia" placeholder="PROVINCIA ORIGEN">
                            <datalist id="filtro_origen_provincia">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if (count($viajes_municipio) > 0): ?> <div class="contenedor_origen"> <!-- FILTRO ORIGEN MUNICIPIO -->
                        <input list="filtro_origen_municipio" name="filtro_origen_municipio" placeholder="MUNICIPIO ORIGEN">
                        <datalist id="filtro_origen_municipio"> <?php foreach ($viajes_municipio as $viaje_municipio): ?>
                                <option value="<?php echo $viaje_municipio['MUNICIPIO']; ?>">
                            <?php endforeach; ?>
                        </datalist>  
                    </div>
                <?php else: ?>
                    <div class="contenedor_origen">
                            <input list="filtro_origen_municipio" name="filtro_origen_municipio" placeholder="MUNICIPIO ORIGEN">
                            <datalist id="filtro_origen_municipio">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if (count($viajes_cp) > 0): ?> <div class="contenedor_origen"> <!-- FILTRO ORIGEN CP -->
                        <input list="filtro_origen_cp" name="filtro_origen_cp" placeholder="CP ORIGEN">
                        <datalist id="filtro_origen_cp"> <?php foreach ($viajes_cp as $viaje_cp): ?>
                                <option value="<?php echo $viaje_cp['CP']; ?>">
                            <?php endforeach; ?>
                        </datalist>  
                    </div>
                <?php else: ?>
                    <div class="contenedor_origen">
                            <input list="filtro_origen_cp" name="filtro_origen_cp" placeholder="CP ORIGEN">
                            <datalist id="filtro_origen_cp">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if(count($viajes_pais) > 0): ?> <div class="contenedor_destino"> <!-- FILTRO DESTINO PAIS -->
                        <input list="filtro_destino_pais" name="filtro_destino_pais" placeholder="PAIS DESTINO">
                        <datalist id="filtro_destino_pais">
                            <?php foreach ($viajes_pais as $viaje_pais): ?>
                                <option value="<?php echo $viaje_pais['PAIS']; ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                <?php else: ?>
                    <div class="contenedor_destino">
                            <input list="filtro_destino_pais" name="filtro_destino_pais" placeholder="PAIS DESTINO">
                            <datalist id="filtro_destino_pais">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if(count($viajes_provincia) > 0): ?> <div class="contenedor_destino"> <!-- FILTRO DESTINO PROVINCIA -->
                        <input list="filtro_destino_provincia" name="filtro_destino_provincia" placeholder="PROVINCIA DESTINO">
                        <datalist id="filtro_destino_provincia">
                            <?php foreach ($viajes_provincia as $viaje_provincia): ?>
                                <option value="<?php echo $viaje_provincia['PROVINCIA']; ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                <?php else: ?>
                    <div class="contenedor_destino">
                            <input list="filtro_destino_provincia" name="filtro_destino_provincia" placeholder="PROVINCIA DESTINO">
                            <datalist id="filtro_destino_provincia">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  
                
<!------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if(count($viajes_municipio) > 0): ?> <div class="contenedor_destino"> <!-- FILTRO DESTINO MUNICIPIO -->
                        <input list="filtro_destino_municipio" name="filtro_destino_municipio" placeholder="MUNICIPIO DESTINO">
                        <datalist id="filtro_destino_municipio">
                            <?php foreach ($viajes_municipio as $viaje_municipio): ?>
                                <option value="<?php echo $viaje_municipio['MUNICIPIO']; ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                <?php else: ?>
                    <div class="contenedor_destino">
                            <input list="filtro_destino_municipio" name="filtro_destino_municipio" placeholder="MUNICIPIO DESTINO">
                            <datalist id="filtro_destino_municipio">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!------------------------------------------------------------------------------------------------------------------------------- -->

                <?php if(count($viajes_cp) > 0): ?> <div class="contenedor_destino"> <!-- FILTRO DESTINO CP -->
                        <input list="filtro_destino_cp" name="filtro_destino_cp" placeholder="CP DESTINO">
                        <datalist id="filtro_destino_cp">
                            <?php foreach ($viajes as $viaje): ?>
                                <option value="<?php echo $viaje['CP']; ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                <?php else: ?>
                    <div class="contenedor_destino">
                            <input list="filtro_destino_cp" name="filtro_destino_cp" placeholder="CP DESTINO">
                            <datalist id="filtro_destino_cp">
                            <option value="">
                            </datalist>  
                    </div>
                <?php endif; ?>  

<!------------------------------------------------------------------------------------------------------------------------------- -->
            
            <input type="date" name="filtro_fecha">

            <input type="text" name="filtro_plazas" placeholder="Nº de Plazas">

            <button type="submit">BUSCAR</button>
        </fieldset>
        
    </form>
</div>


<div class="filtro_resultado"> <!-- ESTO VA A BUSCAR TODOS LOS VIAJES DISPONIBLES PARA TENERLO PREPARADO PARA CUANDO ALGUIEN BUSQUE ALGO -->

    <?php 
        $filtro_origen_pais = $_GET['filtro_origen_pais'] ?? '';
        $filtro_origen_provincia = $_GET['filtro_origen_provincia'] ?? '';
        $filtro_origen_municipio = $_GET['filtro_origen_municipio'] ?? '';
        $filtro_origen_cp = $_GET['filtro_origen_cp'] ?? '';
        $filtro_destino_pais = $_GET['filtro_destino_pais'] ?? '';
        $filtro_destino_provincia = $_GET['filtro_destino_provincia'] ?? '';
        $filtro_destino_municipio = $_GET['filtro_destino_municipio'] ?? '';
        $filtro_destino_cp = $_GET['filtro_destino_cp'] ?? '';
        $filtro_fecha = $_GET['filtro_fecha'] ?? '';
        $filtro_plazas = $_GET['filtro_plazas'] ?? '';

        
        $filtro_viaje = "SELECT U.NOMBRE, U.APELLIDO1, U.APELLIDO2, U.COCHE, U.FOTO, C1.PAIS AS PAIS_ORIGEN,C1.PROVINCIA AS PROVINCIA_ORIGEN,C1.MUNICIPIO AS MUNICIPIO_ORIGEN,C1.CP AS CP_ORIGEN, C2.PAIS AS PAIS_DESTINO, C2.PROVINCIA AS PROVINCIA_DESTINO,C2.MUNICIPIO AS MUNICIPIO_DESTINO,C2.CP AS CP_DESTINO, V.FECHA_HORA, V.PLAZAS_TOTALES, V.PRECIO, V.DESCRIPCION_EXTRA FROM VIAJES V INNER JOIN USUARIO U ON U.ID = V.CONDUCTOR_ID INNER JOIN CIUDADES C1 ON C1.ID = V.ID_ORIGEN INNER JOIN CIUDADES C2 ON C2.ID = V.ID_DESTINO WHERE 1=1";

        if (!empty($filtro_origen_pais)) {
            $filtro_viaje .= " AND C1.PAIS LIKE :PAIS_ORIGEN";
        }
        if (!empty($filtro_origen_provincia)) {
            $filtro_viaje .= " AND C1.PROVINCIA LIKE :PROVINCIA_ORIGEN";
        }
        if (!empty($filtro_origen_municipio)) {
            $filtro_viaje .= " AND C1.MUNICIPIO LIKE :MUNICIPIO_ORIGEN"; 
        }
        if (!empty($filtro_origen_cp)) {
            $filtro_viaje .= " AND C1.CP LIKE :CP_ORIGEN";
        }
        if (!empty($filtro_destino_pais)) {
            $filtro_viaje .= " AND C2.PAIS LIKE :PAIS_DESTINO";
        }
        if (!empty($filtro_destino_provincia)) {
            $filtro_viaje .= " AND C2.PROVINCIA LIKE :PROVINCIA_DESTINO";
        }
        if (!empty($filtro_destino_municipio)) {
            $filtro_viaje .= " AND C2.MUNICIPIO LIKE :MUNICIPIO_DESTINO";
        }
        if (!empty($filtro_destino_cp)) {
            $filtro_viaje .= " AND C2.CP LIKE :CP_DESTINO";
        }
        if (!empty($filtro_fecha)) {
            $filtro_viaje .= " AND DATE(V.FECHA_HORA) = :fecha";
        }
        if (!empty($filtro_plazas)) {
            $filtro_viaje .= " AND V.PLAZAS_TOTALES = :plazas";
        }

        $stmt = $pdo->prepare($filtro_viaje);

        if (!empty($filtro_origen_pais)) {
            $stmt->bindValue(':PAIS_ORIGEN', '%' . $filtro_origen_pais . '%');
        }
        if (!empty($filtro_origen_provincia)) {
            $stmt->bindValue(':PROVINCIA_ORIGEN', '%' . $filtro_origen_provincia . '%');
        }
        if (!empty($filtro_origen_municipio)) {
            $stmt->bindValue(':MUNICIPIO_ORIGEN', '%' . $filtro_origen_municipio . '%');
        }
        if (!empty($filtro_origen_cp)) {
            $stmt->bindValue(':CP_ORIGEN', '%' . $filtro_origen_cp . '%');
        }
        if (!empty($filtro_destino_pais)) {
            $stmt->bindValue(':PAIS_DESTINO', '%' . $filtro_destino_pais . '%');
        }
        if (!empty($filtro_destino_provincia)) {
            $stmt->bindValue(':PROVINCIA_DESTINO', '%' . $filtro_destino_provincia . '%');
        }
        if (!empty($filtro_destino_municipio)) {
            $stmt->bindValue(':MUNICIPIO_DESTINO', '%' . $filtro_destino_municipio . '%');
        }
        if (!empty($filtro_destino_cp)) {
            $stmt->bindValue(':CP_DESTINO', '%' . $filtro_destino_cp . '%');
        }
        if (!empty($filtro_fecha)) {
            $stmt->bindValue(':fecha', $filtro_fecha);
        }
        if (!empty($filtro_plazas)) {
            $stmt->bindValue(':plazas', (int)$filtro_plazas);
        }

        $stmt->execute();
        $infoviaje = $stmt->fetchAll(PDO::FETCH_ASSOC); // GUARDA TODO LO DE ESTA CONSULTA EN LA VARIABLE INFOVIAJE //
    ?>

    <?php if (count($infoviaje) > 0): ?> <!-- SI HAY VIAJES DIPONIBLES, LOS MUESTRA, SI NO HAY DA UN MENSAJE Y MUESTRA TODOS LOS VIAJES -->
    <div class="contenedor_viajes">
        <?php foreach ($infoviaje as $viaje): ?>
            <div class="viaje">
                <h3>Viaja con <?php echo ($viaje['NOMBRE'] . ' ' . $viaje['APELLIDO1'] . ' ' . $viaje['APELLIDO2']); ?></h3>
                <img src="<?php echo '../assets/img/perfilusuario/' . $viaje['FOTO']; ?>" alt="Foto <?php echo $viaje['NOMBRE']; ?>" height="50" width="50">
                <p>Origen: <?php echo ($viaje['PAIS_ORIGEN'] . ', ' . $viaje['PROVINCIA_ORIGEN'] . ', ' . $viaje['MUNICIPIO_ORIGEN'] . ', ' . $viaje['CP_ORIGEN']); ?></p>
                <p>Destino: <?php echo ($viaje['PAIS_DESTINO'] . ', ' . $viaje['PROVINCIA_DESTINO'] . ', ' . $viaje['MUNICIPIO_DESTINO'] . ', ' . $viaje['CP_DESTINO']); ?></p>
                <p>Fecha y hora: <?php echo $viaje['FECHA_HORA']; ?></p>
                <p>Plazas totales: <?php echo $viaje['PLAZAS_TOTALES']; ?></p>
                <p>Precio: <?php echo $viaje['PRECIO']; ?></p>
                <p>Descripción extra: <?php echo $viaje['DESCRIPCION_EXTRA']; ?></p>
                <button type="button">Reservar</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>

        <p>No hay viajes disponibles con estos filtros</p>

        <?php $error_busqueda = "SELECT U.NOMBRE, U.APELLIDO1, U.APELLIDO2, U.COCHE, U.FOTO, C1.PAIS AS PAIS_ORIGEN,C1.PROVINCIA AS PROVINCIA_ORIGEN,C1.MUNICIPIO AS MUNICIPIO_ORIGEN,C1.CP AS CP_ORIGEN, C2.PAIS AS PAIS_DESTINO, C2.PROVINCIA AS PROVINCIA_DESTINO,C2.MUNICIPIO AS MUNICIPIO_DESTINO,C2.CP AS CP_DESTINO, V.FECHA_HORA, V.PLAZAS_TOTALES, V.PRECIO, V.DESCRIPCION_EXTRA FROM VIAJES V INNER JOIN USUARIO U ON U.ID = V.CONDUCTOR_ID INNER JOIN CIUDADES C1 ON C1.ID = V.ID_ORIGEN INNER JOIN CIUDADES C2 ON C2.ID = V.ID_DESTINO WHERE 1=1;" ?>
        <?php $stmt = $pdo->prepare($error_busqueda);
        $stmt->execute();

        $error_viajes = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

        <?php foreach ($error_viajes as $viaje): ?>
            <div class="viaje">
                <h3>Viaja con <?php echo ($viaje['NOMBRE'] . ' ' . $viaje['APELLIDO1'] . ' ' . $viaje['APELLIDO2']); ?></h3>
                <img src="<?php echo '../assets/img/perfilusuario/' . $viaje['FOTO']; ?>" alt="Foto <?php echo $viaje['NOMBRE']; ?>" height="50" width="50">
                <p>Origen: <?php echo ($viaje['PAIS_ORIGEN'] . ', ' . $viaje['PROVINCIA_ORIGEN'] . ', ' . $viaje['MUNICIPIO_ORIGEN'] . ', ' . $viaje['CP_ORIGEN']); ?></p>
                <p>Destino: <?php echo ($viaje['PAIS_DESTINO'] . ', ' . $viaje['PROVINCIA_DESTINO'] . ', ' . $viaje['MUNICIPIO_DESTINO'] . ', ' . $viaje['CP_DESTINO']); ?></p>
                <p>Fecha y hora: <?php echo $viaje['FECHA_HORA']; ?></p>
                <p>Plazas totales: <?php echo $viaje['PLAZAS_TOTALES']; ?></p>
                <p>Precio: <?php echo $viaje['PRECIO']; ?></p>
                <p>Descripción extra: <?php echo $viaje['DESCRIPCION_EXTRA']; ?></p>
                <button type="button">Reservar</button>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
    </div>

</div>