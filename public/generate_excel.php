<?php include 'functions.php'; ?>

<?php
  $config = include 'config.php';
  

  header("Pragma: public");
  header("Expires: 0");
  $filename = "reporte.xls";
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename");
  header("Pragma: no-cache");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

  $data = 
    array(
      'process_event' => $_GET['process_event'],
      'object_description' => $_GET['object_description'],
      'user' => $_GET['user'],
      'status_id' => $_GET['status_id']
    );

  $process_events = searchAccordingToFilter($data, $config);
?>

<table>
  <thead">
    <tr>
      <th>ID oferta</th>
      <th>Creador oferta</th>
      <th>Objeto</th>
      <th>Actividad</th>
      <th>Descripción</th>
      <th>Moneda</th>
      <th>Presupuesto</th>
      <th>Fecha Inicio</th>
      <th>Hora Inicio</th>
      <th>Fecha Cierre</th>
      <th>Hora Cierre</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if (isset($process_events)) {
        while ($process_event = $process_events->fetch()) { ?>
        <tr>
          <td><?php echo $process_event['id']; ?></td>
          <td><?php echo $process_event['user']; ?></td>
          <td><?php echo $process_event['object']; ?></td>
          <td><?php echo $process_event['activity']; ?></td>
          <td><?php echo $process_event['description']; ?></td>
          <td><?php echo $process_event['currency']; ?></td>
          <td><?php echo $process_event['budget']; ?></td>
          <td><?php echo $process_event['start_date']; ?></td>
          <td><?php echo $process_event['start_hour']; ?></td>
          <td><?php echo $process_event['end_date']; ?></td>
          <td><?php echo $process_event['end_hour']; ?></td>
          <td><?php echo $process_event['status']; ?></td>
        </tr>
    <?php
        }
      }
    ?>
  </tbody>
</table>