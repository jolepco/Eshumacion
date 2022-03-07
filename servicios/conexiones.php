<?php

ini_set('display_errors', '1');
cargarEmpresas();
actualizarEmpresa();

function conectarDB() {
    $servidor = "localhost";
    $usuario_db = "serviciosweb";
    $pwd_db = "serviciosZeety";
    $nombre_db = "sitios";

    $dsn = 'mysql:dbname=' . $nombre_db . ';host=' . $servidor;
    try {
        return $con = new PDO($dsn, $usuario_db, $pwd_db);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }
}

function cargarEmpresas() {

    $con = conectarDB();

    $ruta = '/home/ubuntu/frappe-bench/sites/';
    //$arreglo = listar_directorios_ruta('/home/ubuntu/frappe-bench/sites/');

    if ($dh = opendir($ruta)) {
        while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
            if (is_dir($ruta . $file) && $file != "." && $file != "..") {
                //solo si el archivo es un directorio, distinto que "." y ".." 
                if ($dp = opendir($ruta . $file)) {
                    while (($files = readdir($dp)) !== false) {
                        //echo "<br>Nombre de archivo: $files : Es un: " . filetype($ruta . $file . '/' . $files);
                        if ($files == "site_config.json") {
                            $data = file_get_contents($ruta . $file . '/' . $files);
                            $datos = json_decode($data, true);
                            var_dump($datos);
                            for ($i = 0; $i < count($datos); $i++) {

                                $sql = "SELECT id_empresa, db, user, pass, estado ";
                                $sql .= " FROM empresas  ";
                                $sql .= " WHERE db = '" . $datos['db_name'] . "'  ";

                                $query = $con->query($sql);
                                $filas = $query->fetchAll(PDO::FETCH_ASSOC);

                                if (count($filas) <= 0) {
                                    $sql = "INSERT INTO empresas (db, user, pass, port, estado)";
                                    $sql .= " VALUES('" . $datos['db_name'] . "', '" . $datos['db_name'] . "', '" . $datos['db_password'] . "', '".$datos['nginx_port']."', 'AC');  ";

                                    $query = $con->query($sql);
                                    echo "<pre>";
                                    echo "<p>Se registro la empresa con exito</p>";
                                    echo "</pre>";
                                } else {
                                    
                                    $sql = "UPDATE empresas SET port = '".$datos['nginx_port']."' WHERE db = '" . $datos['db_name'] . "'";

                                    $query = $con->query($sql);
                                    
                                    echo "<pre>";
                                    echo "<p>Empresa ya registrada</p>";
                                    echo "</pre>";
                                }
                            }
                        }
                    }
                }
            }
        }
        closedir($dh);
    }
}

function actualizarEmpresa() {

    $con = conectarDB();

    $sql = "SELECT id_empresa, db, user, pass, estado ";
    $sql .= " FROM empresas  ";

    $query = $con->query($sql);
    $filas = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($filas); $i++) {

        $servidor = 'localhost';
        $db = $filas[$i]['db'];
        $user = $filas[$i]['user'];
        $pass = $filas[$i]['pass'];

        $dsn = 'mysql:dbname=' . $db . ';host=' . $servidor;
        try {
            $conexion = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

        if ($conexion) {
            $sql = "SELECT company_name ";
            $sql .= " FROM tabCompany  ";

            $query = $conexion->query($sql);
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultado) > 0) {
                $arregloEmpresa = '';
                for ($j = 0; $j < count($resultado); $j++) {
                    $arregloEmpresa .= $resultado[$j]['company_name']." - ";
                }

                $sql = "UPDATE empresas set nomb_empresa = '" . $arregloEmpresa . "' ";
                $sql .= " WHERE db = '" . $db . "'";

                $query = $con->query($sql);
            }else{
                $sql = "UPDATE empresas set nomb_empresa = '' ";
                $sql .= " WHERE db = '" . $db . "'";

                $query = $con->query($sql);
            }
        }
    }
}

function listar_directorios_ruta($ruta) {
    // abrir un directorio y listarlo recursivo 
    if (is_dir($ruta)) {
        if ($dh = opendir($ruta)) {
            while (($file = readdir($dh)) !== false) {
                //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                //mostraría tanto archivos como directorios 
                //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
                if (is_dir($ruta . $file) && $file != "." && $file != "..") {
                    //solo si el archivo es un directorio, distinto que "." y ".." 
                    echo "<br>Directorio: $ruta$file";
                    listar_directorios_ruta($ruta . $file . "/");
                }
            }
            closedir($dh);
        }
    } else
        echo "<br>No es ruta valida";
}

