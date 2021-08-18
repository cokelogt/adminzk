<?php
        $connect = pg_connect("host='localhost' 
                                               port=5433 
                                               dbname='adminzk' 
                                               user='postgres' 
                                               password='datsun' 
                                               options='--client_encoding=UTF8'");
    pg_query("SET NAMES 'utf8'");
    define('METHOD','AES-256-CBC');
    define('SECRET_KEY','myzkteco');
    define('SECRET_IV','17202045');

function cript($string){
    $output=FALSE;
    $key=hash('sha256', SECRET_KEY);
    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output=base64_encode($output);
    return $output;
}
function decript($string){
    $key=hash('sha256', SECRET_KEY);
    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
}
    function elegir($pgsql,$idc,$nombre,$n,$par)
    {
    echo '<select id="'.$nombre.'" name="'. $nombre . '" '. $par .' class="form-control form-control-sm">';
    $resultado=pg_query($pgsql);
    echo '<option value="0">--Select--</option>';
    while ($fila=pg_fetch_row($resultado)){
      if ($fila[0]==$idc){
         echo "<option selected value='$fila[0]'>$fila[$n]";
            }
            else{
              echo "<option value='$fila[0]'>$fila[$n]";
            }
      }
          echo "</select>";
    }

    function pg_sql($db, $name, $query, $array) {
        $sql = pg_prepare($db, $name, $query);
        $sql = pg_execute($db, $name, $array);
        return $sql;
    }

?>
