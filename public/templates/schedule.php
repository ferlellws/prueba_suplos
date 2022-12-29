<form method="post">
  <input type="hidden" name="step" value="schedule">
  <input type="hidden" name="process_event_id" value="<?php echo $_GET['process_event_id']; ?>">
  <div class="grid gap-6 mb-6 grid-cols-4">
      <div>
          <label for="first_name" class="label-input">Fecha Inicio (*)</label>
          <input type="date"
            id="start-date"
            name="start_date"
            class="input-field-process-rounded"
            pattern="\d{4}-\d{2}-\d{2}"
            required>
      </div>
      <div>
          <label for="last_name" class="label-input">Hora Inicio (*)</label>
          <input type="time"
            id="start-hour"
            name="start_hour"
            class="input-field-process-rounded"
            required>
      </div>
      <div>
          <label for="first_name" class="label-input">Fecha Cierre (*)</label>
          <input type="date"
            id="end-date"
            name="end_date"
            class="input-field-process-rounded"
            pattern="\d{4}-\d{2}-\d{2}"
            required>
      </div>
      <div>
          <label for="last_name" class="label-input">Hora Cierre (*)</label>
          <input type="time"
            id="end-hour"
            name="end_hour"
            class="input-field-process-rounded"
            required>
      </div>
  </div>

  <div class="flex justify-center mt-6">
    <button type="submit" class="btn-submit">Publicar</button>
  </div>
</form>