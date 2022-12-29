<?php

$config = include 'config.php';
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$connection = new PDO(
  $dsn,
  $config['db']['user'],
  $config['db']['pass'],
  $config['db']['options']
);

$processEventsAttachmentQuery = "SELECT *
                                FROM process_event_attachments
                                WHERE
                                  id = :id";

$sentencia = $connection->prepare($processEventsAttachmentQuery);
$sentencia->setFetchMode(PDO::FETCH_ASSOC);
$sentencia->bindValue(':id', (int) $_GET['process_event_attachment_id']);
$sentencia->execute();
while ($process_event_attachment = $sentencia->fetch()) {
  $file = $process_event_attachment['file'];
  $type_file = $process_event_attachment['type_file'];
  $name = $process_event_attachment['name'];
  header('Content-type: ' . $type_file);
  header('Content-Disposition: attachment; filename="' . $name . '"');
  echo $file;
}
