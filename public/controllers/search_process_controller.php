<?php include 'functions.php'; ?>

<?php
$config = include 'config.php';

$data = $_POST;

$statuses = getStatuses($config);

if (isset($_POST['btn_search']) || isset($_POST['btn_excel'])) {
  $process_events = searchAccordingToFilter($data, $config);
}

if (isset($_POST['btn_excel'])) {
  $strParameters = getParameters($data);
  header("Location: generate_excel.php?$strParameters");
}

/**
 * It takes an array of parameters and values and returns a string of parameters and values.
 *
 * @param data The data to be sent to form
 *
 * @return the parameters of the data.
 */
function getParameters($data) {
  $strParameters = "";
  foreach ($data as $param => $value) {
    $strParameters .= $param . "=" . $value . "&";
  }
  return $strParameters;
}

/**
 * It connects to the database, prepares a query, executes it and returns the statuses
 * 
 * @param config This is the configuration array for database.
 * 
 * @return An array of statuses
 */
function getStatuses($config) {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $connection = new PDO(
    $dsn,
    $config['db']['user'],
    $config['db']['pass'],
    $config['db']['options']
  );

  $processEventsQuery = "SELECT id, name
                        FROM statuses";

  $sentencia = $connection->prepare($processEventsQuery);
  $sentencia->setFetchMode(PDO::FETCH_ASSOC);
  
  if ($sentencia->execute()) {
    return $sentencia;
  } else {
    echo "<br>Ha ocurrido un error";
  }
}
?>