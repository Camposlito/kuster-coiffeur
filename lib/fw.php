<?php

include 'config.php';

date_default_timezone_set($config['DEFAULT_TIME_ZONE']);

function absolutePath($relativePath)
{
  global $config;
  static $prefix = null;
  if($prefix == null)
  {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $appPrefix = $config['APP_PREFIX'];
    $pos = strpos($scriptName,$appPrefix);
    if($pos >= 0)
    {
      $prefix = substr($scriptName,0,$pos) . $appPrefix . '/';
    }
    else
    {
      error_log("Erro na configuração da aplicação. Prefixo $appPrefix não é parte do nome do script $scriptName.");
      die();
    }
  }

  return $prefix . $relativePath;
}

function getConnection()
{
    static $dbh = null;
    global $config;
    global $host, $user, $database, $pass;

    if($dbh == null)
    {
        $host = $config["DB_HOST"];
        $user = $config["DB_USER"];
        $database = $config["DB_DATABASE"];
        $pass = $config["DB_PASSWORD"];
        // Try to open connection to mysql database
        try
        {
            $dbh = new PDO("mysql:host={$host};dbname={$database};charset=utf8",$user,$pass);
        }
        catch(PDOException $e)
        {
            error_log("Unable to open connection {$user}@{$host} database {$database} using password.");
            header('HTTP/1.1 500 Internal Server Error');
            die();
        }
    }
    return $dbh;
}

function sqlInsert($tableName, $newRecord)
{
    $sep = "";
    $sql = "INSERT INTO $tableName (";
    foreach($newRecord as $fieldName => $fieldValue)
    {
        $sql .= "{$sep}{$fieldName}";
        $sep = ",";
    }
    $sql .= ") VALUES (";
    $sep = "";
    foreach($newRecord as $fieldName => $fieldValue)
    {
        $sql .= "{$sep}:{$fieldName}";
        $sep = ",";
    }
    $sql .= ")";
    $stm = getConnection()->prepare($sql);
    foreach($newRecord as $fieldName => $fieldValue)
    {
        if($fieldValue === "")
        {
            $fieldValue = NULL;
        }
        if(gettype($fieldValue) == "object" && get_class($fieldValue) == "DateTime")
        {
            $stm->bindValue(":{$fieldName}",dateToSQL($fieldValue));
        }
        else
        {
            $stm->bindValue(":{$fieldName}",$fieldValue);
        }
    }

    if($stm->execute())
    {
        $lastid = getConnection()->lastInsertId();
        return $lastid ? $lastid : TRUE;
    }
    else
    {
        print_r($stm->errorInfo());
        return FALSE;
    }
}

function sqlUpdate($tableName, $record, $key)
{
    $sep = "";
    $sql = "UPDATE $tableName SET ";
    foreach($record as $fieldName => $fieldValue)
    {
        $sql .= "{$sep}{$fieldName}=:{$fieldName}";
        $sep = ",";
    }
    $sql .= " WHERE ";
    $sep = "";
    foreach($key as $fieldName => $fieldValue)
    {
        $sql .= "{$sep}{$fieldName}=:{$fieldName}";
        $sep = " AND ";
    }

    $stm = getConnection()->prepare($sql);
    foreach($record as $fieldName => $fieldValue)
    {
        if($fieldValue === "")
        {
            $fieldValue = NULL;
        }
        if(gettype($fieldValue) == "object" && get_class($fieldValue) == "DateTime")
        {
            $stm->bindValue(":{$fieldName}",dateToSQL($fieldValue));
        }
        else
        {
            $stm->bindValue(":{$fieldName}",$fieldValue);
        }
    }
    foreach($key as $fieldName => $fieldValue)
    {
        if(gettype($fieldValue) == "object" && get_class($fieldValue) == "DateTime")
        {
            $stm->bindValue(":{$fieldName}",dateToSQL($fieldValue));
        }
        else
        {
            $stm->bindValue(":{$fieldName}",$fieldValue);
        }
    }
    return $stm->execute();
}

function sqlSelectFirst($tableName, $where = null)
{
    $sql = "SELECT * FROM $tableName";
    if($where)
    {
        $sep = " WHERE ";
        foreach($where as $fieldName => $fieldValue)
        {
            $sql .= "{$sep}{$fieldName}=:{$fieldName}";
            $sep = " AND ";
        }
    }
    $stm = getConnection()->prepare($sql);
    if($where)
    {
        foreach($where as $fieldName => $fieldValue)
        {
            if(gettype($fieldValue) == "object" && get_class($fieldValue) == "DateTime")
            {
                $stm->bindValue(":{$fieldName}",dateToSQL($fieldValue));
            }
            else
            {
                $stm->bindValue(":{$fieldName}",$fieldValue);
            }
        }
    }
    if($stm->execute())
    {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $row;
    }
    else
    {
        return null;
    }
}

/*------------------------------------
            MINHAS FUNÇÕES
--------------------------------------
*/

function getIdCliente($nome){
  $dado = array (
    "nome" => $nome
  );
  $row = sqlSelectFirst("info_cliente", $dado);
  return $row["id"];
}

function addCliente($nome, $email, $cell1, $cell2, $tell, $mes, $dia){
  $dados = array(
    "nome" => $nome,
    "email" => $email,
    "cell1" => $cell1,
    "cell2" => $cell2,
    "tell_fixo" => $tell,
    "niver_mes" => $mes,
    "niver_dia" => $dia
  );
  sqlInsert("info_cliente", $dados);
}

function addServico($id_cliente, $data, $descricao){
  $dados = array(
    "id_cliente" => $id_cliente,
    "data" => $data,
    "descricao" => $descricao
  );
  sqlInsert("servico", $dados);
}

function contNiverDia($dia, $mes){
  $sql = "SELECT * FROM info_cliente where niver_dia = '$dia' AND niver_mes = '$mes'";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  echo (int) $resultado->rowCount();
  $conn = null;
}

function contClientes(){
  $sql = "SELECT * FROM info_cliente";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  return (int) $resultado->rowCount();
  $conn = null;
}

function ListarNiverHoje($dia, $mes){
  $sql = "SELECT * FROM info_cliente WHERE niver_dia = '$dia' AND niver_mes = '$mes'";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    foreach ($resultado as $row) {
      echo '<tr class="table-success">';
      echo '  <th scope="row"><i class="fas fa-birthday-cake"></i></th>';
      echo '  <td>';
      echo $row["nome"];
      echo '</td>';
      echo '  <td>';
      echo $row["email"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell1"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell2"];
      echo '</td>';
      echo '</tr>';
    }
  }
  $conn = null;
}

function ListarNiverAmanha($dia, $mes){
  $dia = $dia + 1;
  $sql = "SELECT * FROM info_cliente WHERE niver_dia = '$dia' AND niver_mes = '$mes'";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    foreach ($resultado as $row) {
      echo '<tr class="table-info">';
      echo '  <th scope="row">';
      echo $row["niver_dia"];
      echo '</th>';
      echo '  <td>';
      echo $row["nome"];
      echo '</td>';
      echo '  <td>';
      echo $row["email"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell1"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell2"];
      echo '</td>';
      echo '</tr>';
    }
  }
  $conn = null;
}

function ListarNiverMes($dia, $mes){
  $amanha = $dia + 1;
  $sql = "SELECT * FROM info_cliente WHERE niver_mes = '$mes'";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    foreach ($resultado as $row) {
      if ($row["niver_dia"] != $dia) {
        if ($row["niver_dia"] != $amanha) {
          echo '<tr>';
          echo '  <th scope="row">';
          echo $row["niver_dia"];
          echo '</th>';
          echo '  <td>';
          echo $row["nome"];
          echo '</td>';
          echo '  <td>';
          echo $row["email"];
          echo '</td>';
          echo '  <td>';
          echo $row["cell1"];
          echo '</td>';
          echo '  <td>';
          echo $row["cell2"];
          echo '</td>';
          echo '</tr>';
        }
      }
    }
  }
  $conn = null;
}

function converteMes($mes_num){
  if($mes_num == 1){
    $mes_nome = "Janeiro";
    }elseif($mes_num == 2){
    $mes_nome = "Fevereiro";
    }elseif($mes_num == 3){
    $mes_nome = "Março";
    }elseif($mes_num == 4){
    $mes_nome = "Abril";
    }elseif($mes_num == 5){
    $mes_nome = "Maio";
    }elseif($mes_num == 6){
    $mes_nome = "Junho";
    }elseif($mes_num == 7){
    $mes_nome = "Julho";
    }elseif($mes_num == 8){
    $mes_nome = "Agosto";
    }elseif($mes_num == 9){
    $mes_nome = "Setembro";
    }elseif($mes_num == 10){
    $mes_nome = "Outubro";
    }elseif($mes_num == 11){
    $mes_nome = "Novembro";
    }else{
    $mes_nome = "Dezembro";
    }
    echo $mes_nome;
}

function ListarClientes(){
  $sql = "SELECT * FROM info_cliente";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    foreach ($resultado as $row) {
      echo '<tr>';
      echo '  <td class="text-left">';
      echo $row["nome"];
      echo '</td>';
      echo '  <td>';
      echo $row["email"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell1"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell2"];
      echo '</td>';
      echo '  <td> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#detalhesModal" data-whatever="';
      echo $row["id"];
      echo '"><i class="fas fa-bars"></i></button> </td>';
      echo '</tr>';
    }
  }
  $conn = null;
}

function getNomeById($id){
  $dado = array (
    "id" => $id
  );
  $row = sqlSelectFirst("info_cliente", $dado);
  return $row["nome"];
}

function getUltimoServ($id){
  $dia = "";
  $mes = "";
  $ano = "";
  $servico = "";
  $sql = "SELECT * FROM servico WHERE id_cliente = '$id'";
  $conn = getConnection();
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    //loop para cada string de data disponivel
    foreach ($resultado as $row) {
      if (!is_null($row["data"])) {
        //divide data em 3 arrays
        $splitData = explode("/", $row["data"]);
        $servComp = $row["descricao"];
        //compara cada ano
        if ($splitData[2] == $ano) {
          //compara cada mes
          if ($splitData[1] == $mes) {
            //compara cada dia
            if ($splitData[0] >= $dia) {
              $servico = $servComp;
              $dia = $splitData[0];
            }
          }
          if ($splitData[1] > $mes) {
            $servico = $servComp;
            $mes = $splitData[1];
            $dia = $splitData[0];
          }
        }
        if ($splitData[2] > $ano) {
          $servico = $servComp;
          $ano = $splitData[2];
          $mes = $splitData[1];
          $dia = $splitData[0];
        }
      }
    }
  }
  $conn = null;
  if (($dia == "") && ($mes == "") && ($ano == "") && ($servico == "")) {
    return "";
  }else {
    return $dia."/".$mes."/".$ano." - ".$servico;
  }
}


 ?>
