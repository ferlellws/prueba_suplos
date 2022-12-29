<?php

$config = include 'config.php';

try {
  $connection = new PDO(
    'mysql:host=' . $config['db']['host'],
    $config['db']['user'],
    $config['db']['pass'],
    $config['db']['options']
  );
  $sql = file_get_contents("../data/migration.sql");

  $connection->exec($sql);

  createTableActivitiesAndSeed($connection);

  echo "La base de datos y las tablas se han creado con éxito.";
} catch(PDOException $error) {
  echo $error->getMessage();
}


function createTableActivitiesAndSeed($connection) {
  $fp = fopen("../data/clasificador_de_bienes_y_servicios_v14_1.csv", "r");

  $row = 0;
  $sqlString = "INSERT INTO activities (code, name) VALUES ";
  while ($data = fgetcsv($fp, 1000, ";")) {
    if ($row > 0) {
      $sqlString .= "(" . $data[6]. ", '" . str_replace("'", "\'", $data[7]) . "'), ";
      if ($row % 900 == 0) {
        cleanSqlAndExec($sqlString, $connection);
        echo "Bloque " . $row / 900 . " finalizado </br>";
        $sqlString = "INSERT INTO activities (code, name) VALUES ";
      }
    }

    $row++;
  }

  cleanSqlAndExec($sqlString, $connection);

  fclose ($fp);
}

function cleanSqlAndExec($sql, $connection) {
  $sql = trim($sql);
  $sql = substr($sql, 0, -1);
  $connection->exec($sql);
}