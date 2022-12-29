<?php
  if ($_GET && $_GET['tab'] == 'documentation') {
    $data = $_GET;
    $process_event_attachments = getProcessEventAttachments($data);
  }

  if ($_POST) {
    $data = $_POST;
    print_r($data);
    switch ($data['step']) {
      case 'schedule':
        saveScheduleProcessEvent($data);
        break;
      case 'documentation':
        $file = $_FILES['process_event_attachment'];
        saveFileProcessEvent($data, $file);
        break;
      default:
        saveProcessEvent($data);
        break;
    }
  }

  /**
   * It saves the process event to the database
   * 
   * @param process_event an array with the following keys:
   */
  function saveProcessEvent($process_event) {
    $config = include 'config.php';
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO(
      $dsn,
      $config['db']['user'],
      $config['db']['pass'],
      $config['db']['options']
    );

    $processEventsQuery = "INSERT INTO process_events (
                          object,
                          description,
                          activity_code,
                          currency,
                          budget
                        ) VALUES (
                          :object,
                          :description,
                          :activity_code,
                          :currency,
                          :budget
                        )";

    echo "<br>activity['object']: " . $process_event['object'];
    $sentencia = $connection->prepare($processEventsQuery);
    $sentencia->bindValue(':object', $process_event['object']);
    $sentencia->bindValue(':description', $process_event['description']);
    $sentencia->bindValue(':activity_code', $process_event['activity']);
    $sentencia->bindValue(':currency', $process_event['currency']);
    $sentencia->bindValue(':budget', $process_event['budget']);
    $sentencia->execute();
    $process_event_id = $connection->lastInsertId();
    header("Location: process.php?tab=schedule&process_event_id=" . $process_event_id);
  }

  /**
   * It updates the start_date, end_date, start_hour and end_hour of a process_event in the database
   * 
   * @param process_event an array with the following keys:
   */
  function saveScheduleProcessEvent($process_event) {
    print_r($process_event);
    $config = include 'config.php';
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO(
      $dsn,
      $config['db']['user'],
      $config['db']['pass'],
      $config['db']['options']
    );

    $processEventsQuery = "UPDATE process_events
                        SET
                          start_date = :start_date,
                          end_date = :end_date,
                          start_hour = :start_hour,
                          end_hour = :end_hour
                        WHERE
                          id = :process_event_id
                      ";

    $sentencia = $connection->prepare($processEventsQuery);
    $sentencia->bindValue(':start_date', $process_event['start_date']);
    $sentencia->bindValue(':end_date', $process_event['end_date']);
    $sentencia->bindValue(':start_hour', $process_event['start_hour']);
    $sentencia->bindValue(':end_hour', $process_event['end_hour']);
    $sentencia->bindValue(':process_event_id', $process_event['process_event_id']);
    if ($sentencia->execute()) {
      header("Location: process.php?tab=documentation&process_event_id=" . $process_event['process_event_id']);
    } else {
      echo "<br>Ha ocurrido un error";
    }
  }

  /**
   * It takes a file and a process event id, and saves the file to the database
   * 
   * @param process_event_attachment is an array with the following keys:
   * @param file The file to upload.
   */
  function saveFileProcessEvent($process_event_attachment, $file) {
    $config = include 'config.php';
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO(
      $dsn,
      $config['db']['user'],
      $config['db']['pass'],
      $config['db']['options']
    );

    $processEventsQuery = "INSERT INTO process_event_attachments (
                          process_event_id,
                          name,
                          title,
                          type_file,
                          description,
                          file
                        ) VALUES (
                          :process_event_id,
                          :name,
                          :title,
                          :type_file,
                          :description,
                          :file
                        )
                      ";

    $sentencia = $connection->prepare($processEventsQuery);
    print_r($file);
    $sentencia->bindValue(':process_event_id', (int) $process_event_attachment['process_event_id']);
    $sentencia->bindValue(':name', $file['name']);
    $sentencia->bindValue(':title', $process_event_attachment['title']);
    $sentencia->bindValue(':type_file', $file['type']);
    $sentencia->bindValue(':description', $process_event_attachment['description']);
    $sentencia->bindValue(':file', file_get_contents($file['tmp_name']));
    if ($sentencia->execute()) {
      header(
        "Location: process.php?tab=documentation&process_event_id=" . $process_event_attachment['process_event_id']
      );
    } else {
      echo "<br>Ha ocurrido un error";
    }
  }

  /**
   * It returns a PDOStatement object with the results of a query.
   * 
   * @param process_event_attachment This is the array that contains the process_event_id.
   * 
   * @return the result of the query about attachments to the process.
   */
  function getProcessEventAttachments($process_event_attachment) {
    $config = include 'config.php';
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO(
      $dsn,
      $config['db']['user'],
      $config['db']['pass'],
      $config['db']['options']
    );

    $processEventsQuery = "SELECT *
                          FROM process_event_attachments
                          WHERE
                            process_event_id = :process_event_id";

    $sentencia = $connection->prepare($processEventsQuery);
    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $sentencia->bindValue(':process_event_id', (int) $process_event_attachment['process_event_id']);
    if ($sentencia->execute()) {
      return $sentencia;
    } else {
      echo "<br>Ha ocurrido un error";
    }
  }
?>