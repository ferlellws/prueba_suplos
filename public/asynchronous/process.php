<?php
  $config = include '../config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO(
      $dsn,
      $config['db']['user'],
      $config['db']['pass'],
      $config['db']['options']
    );

    $activitiesQuery = "SELECT code, name
                        FROM activities
                        WHERE name like :name";

    $sentencia = $connection->prepare($activitiesQuery);
    // echo "==============";
    // print_r($_GET);
    // echo "++++++++++++++";
    $sentencia->bindValue(':name', '%' . $_GET['q'] . '%');
    $sentencia->execute();

    $activities = $sentencia->fetchAll();

    $arrayResponse = [];
    if ($activities && $sentencia->rowCount() > 0) {
      foreach ($activities as $activity) {
        array_push(
          $arrayResponse,
          array(
            "code" => $activity['code'],
            "name" => $activity['name']
          )
        );
      }
    }

    echo json_encode($arrayResponse);

  } catch(PDOException $error) {
    $error = $error->getMessage();
    echo $error;
  }

?>