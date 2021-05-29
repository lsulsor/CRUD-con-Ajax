<?php

class DB {

    /**
     * Conexión con la base de datos mediante PDO
     * @return $con
     */
    public static function conectar() {
        $datos = '';
        $user = '';
        $contra = '';
        $ort = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try {
            $con = new PDO($datos, $user, $contra, $ort);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $con;
    }
    /**
     * Obtener anuncios de la base de datos
     * @return $result
     */
    public static function obtener_anuncios() {
        try {
            //Almacenamos la consulta
            $sql = "SELECT * FROM anuncios";
            $consulta = DB::conectar()->prepare($sql);
            //Ejecutamos la consulta
            $consulta->execute();
            $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            //Capturamos si hay errores
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $result;
    }

    /**
     * Selecciona un anuncio de la base de datos según su id
     * @param type $cod id del anuncio
     * @return $result
     */
    public static function mostrar_borrar($cod) {

        try {
            //Almacenamos la consulta
            $sql = "SELECT * FROM anuncios WHERE id_anuncio = :cod";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':cod', $cod);
            //Ejecutamos la consulta
            $consulta->execute();

            $result = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //devolvemos el resultado
        return $result;
    }

    /**
     * Borra un anuncio de la base de datos según su id y autor
     * @param type $id id del anuncio
     * @param type $autor login del anuncio
     */
    public static function borrar_anuncio($id, $autor) {

        try {
            //Almacenamos la consulta
            $sql = "DELETE FROM anuncios WHERE id_anuncio = :id and autor = :autor";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':autor', $autor);
             //Ejecutamos la consulta
            $consulta->execute();
            //Almacenamos si ha habido algún resultado
            $count = $consulta->rowCount();
            //Sino lo ha habido
            if ($count == 0) {
                //Informamos
                echo "Solo puede eliminar anuncios de su usuario";
                //En caso contrario
            } else {

                echo "Registro eliminado";
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Obtiene un anuncio de la base de datos según su id
     * @param type $id id del anuncio
     * @return $result
     */
    public static function obtener_modificar($id) {
        try {
            //Almacenamos la consulta
            $sql = "SELECT * from anuncios WHERE id_anuncio = :id";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id);
             //Ejecutamos la consulta
            $consulta->execute();
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //devolvemos el resultado
        return $result;
    }

    /**
     * Modificar un anuncio de la base de datos
     * @param type $usuario login del usuario
     * @param type $id id del anuncio
     * @param type $autor del anuncio
     * @param type $moroso moroso del anuncio
     * @param type $localidad localidad del anuncio
     * @param type $descripcion descripcion del anuncio
     * @param type $fecha fecha del anuncio
     */
    public static function modificar_anuncio($usuario, $id, $autor, $moroso, $localidad, $descripcion, $fecha) {
        //Si el login y el autor son iguales
        if ($usuario == $autor) {
            try {
                //Se actualiza el anuncio
                $sql = "UPDATE anuncios SET moroso = '$moroso', localidad = '$localidad', descripcion = '$descripcion', fecha = '$fecha' WHERE id_anuncio = '$id'";
                $consulta = DB::conectar()->prepare($sql);
                $consulta->execute();
                echo "Registro modificaro";
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            //En caso contrario se informa al usuario
        } else {
            echo "Solo puede modificar anuncios de su usuario";
        }
    }
    /**
     * Inserta un anuncio de la base de datos
     * @param type $autor del anuncio
     * @param type $moroso moroso del anuncio
     * @param type $localidad localidad del anuncio
     * @param type $descripcion descripcion del anuncio
     * @param type $fecha fecha del anuncio
     */
    public static function insertar($autor, $moroso, $localidad, $descripcion, $fecha) {
        try {
            //Almacenamos la consulta
            $sql = "INSERT into anuncios (autor, moroso, localidad, descripcion, fecha) VALUES (:autor, :mor, :loc, :des, :fec)";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':autor', $autor);
            $consulta->bindParam(':mor', $moroso);
            $consulta->bindParam(':loc', $localidad);
            $consulta->bindParam(':des', $descripcion);
            $consulta->bindParam(':fec', $fecha);
            //Ejecutamos la consulta
            $consulta->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    /**
     * Mostrar los login bloqueados
     */
    public static function obtener_bloqueados() {
        try {
            //Almacenamos la consulta
            $sql = "SELECT login, email FROM anunciantes where bloqueado=3";
            $consulta = DB::conectar()->prepare($sql);
            //Ejecutamos la consulta
            $consulta->execute();
            $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $result;
    }
    /**
     * Inserta un registro de la base de datos
     * @param type $login login del registro
     * @param type $conUsu contraseña del registro
     * @param type $email_r email del regsitro
     */
    public static function insertar_registro($login, $conUsu, $email_r) {
        //Se cifra la contraseña
        $pass_cifrado = password_hash($conUsu, PASSWORD_DEFAULT, array("cost" => 12));
        $num = 3;
        
        try {
            //Almacenamos la consulta
            $sql = $sql = "INSERT INTO anunciantes(login, password, email,bloqueado) VALUES (:log ,:pass,:email,:bloq)";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':log', $login);
            $consulta->bindParam(':pass', $pass_cifrado);
            $consulta->bindParam(':email', $email_r);
            $consulta->bindParam(':bloq', $num);
              //Ejecutamos la consulta
            $consulta->execute();
           //Creamos una cookie asociada al usuario
           setcookie("bloq" . $login, "Bloqueado");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Se muestra el mapa y la ruta hacia una dirección del anuncio
     * @param type $id id del anuncio
     * @return $result
     */
    public static function mostrar_mapa($id) {
        try {
            //Almacenamos la consulta
            $sql = "SELECT * from anuncios WHERE id_anuncio = :id";
            $consulta = DB::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id);
            //Ejecutamos la consulta
            $consulta->execute();
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //devolvemos el resultado
        return $result;
    }
    /**
     * Desbloquea el login
     * @param type $log login del usuario
     */
    public static function desbloquear($log) {

        try {
             //Almacenamos la consulta
            $sql = "SELECT login FROM anunciantes";
            $consulta = DB::conectar()->prepare($sql);
            //Ejecutamos la consulta
            $consulta->execute();
            $num = 0;
            
            while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                //Si hay algun resultado y son iguales incrementa la variable num
                if ($log == $registro['login']) {
                    $num++;
                }
            }
           //Si num es mayor que cero
            if ($num > 0) {
                //Elimino la coockie
                setcookie("bloq" . $log, "Bloqueado", time() - 1);
                //Acutalizo el campo bloqueado
                 $sql = "UPDATE anunciantes SET bloqueado=0 WHERE login=:miLog";
                  $consulta = DB::conectar()->prepare($sql);
                  $consulta->execute(array(":miLog" => $log));
                  $consulta->execute();
                echo "Login desbloqueado";
            } else {
                echo "No existe ese login";
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}
