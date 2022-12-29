<?php

/**
 * It returns a PDOStatement object with the results of the query.
 * 
 * @param data an array with the following structure:
 * @param config an array with the database configuration
 * 
 * @return The result of the bind variable according to filter.
 */
function searchAccordingToFilter($data, $config) {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $connection = new PDO(
    $dsn,
    $config['db']['user'],
    $config['db']['pass'],
    $config['db']['options']
  );

  $processEventsQuery = "SELECT p.id AS id,
                          concat(u.name, ' ', u.last_name) as user,
                          p.object,
                          a.name AS activity,
                          p.description,
                          p.currency,
                          p.budget,
                          p.start_date,
                          p.end_date,
                          p.start_hour,
                          p.end_hour,
                          s.id AS status_id,
                          s.name AS status
                        FROM process_events p
                            JOIN activities a on p.activity_code = a.code
                            JOIN statuses s on p.status_id = s.id
                            JOIN users u on p.user_id = u.id
                        WHERE p.id > 0";

  $processEventsQuery = getStringQueryAccordingToFilter($data, $processEventsQuery);

  $sentencia = $connection->prepare($processEventsQuery);
  $sentencia->setFetchMode(PDO::FETCH_ASSOC);


  if (isset($data['process_event']) && $data['process_event'] != "") {
    $sentencia->bindValue(':id', (int) $data['process_event']);
  }

  if (isset($data['object_description']) && $data['object_description'] != "") {
    $sentencia->bindValue(':object_description', '%' . $data['object_description'] . '%');
  }

  if (isset($data['user']) && $data['user'] != "") {
    $sentencia->bindValue(':user', '%' . $data['user'] . '%');
  }

  if (isset($data['status_id']) && $data['status_id'] != "") {
    $sentencia->bindValue(':status_id', (int) $data['status_id']);
  }

  if ($sentencia->execute()) {
    return $sentencia;
  } else {
    echo "<br>Ha ocurrido un error";
  }
}

/**
 * It takes a query and a data array and returns a query with the appropriate WHERE clauses
 * 
 * @param data an array of parameters that are used to filter the query
 * @param processEventsQuery The query that will be used to get the data from the database.
 * 
 * @return The query string is being returned.
 */
function getStringQueryAccordingToFilter($data, $processEventsQuery) {
  if (isset($data['process_event']) && $data['process_event'] != "") {
    $processEventsQuery .= " AND p.id = :id";
  }

  if (isset($data['object_description']) && $data['object_description'] != "") {
    $processEventsQuery .= " AND (p.object like :object_description OR p.description like :object_description)";
  }

  if (isset($data['user']) && $data['user'] != "") {
    $processEventsQuery .= " AND concat(u.name, ' ', u.last_name) like :user";
  }

  if (isset($data['status_id']) && $data['status_id'] != "") {
    $processEventsQuery .= " AND s.id = :status_id";
  }

  return $processEventsQuery;
}
?>