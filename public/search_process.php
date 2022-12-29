<?php include 'templates/header.php'; ?>

<?php include 'templates/banner.php'; ?>

<?php include 'controllers/search_process_controller.php'; ?>


  <div class="p-6">
    <form method="POST">
      <div class="grid gap-6 mb-6 grid-cols-3">
          <div>
              <label for="process_event" class="label-input">ID cerrada</label>
              <input type="number"
                id="process_event"
                name="process_event"
                class="input-field-process-rounded"
                placeholder="Número id procesos / eventos"
                value="<?php echo isset($_POST['process_event']) ? $_POST['process_event'] : ''; ?>">
          </div>
          <div>
              <label for="object_description" class="label-input">Objeto / Descripción</label>
              <input type="text"
                id="object_description"
                name="object_description"
                class="input-field-process-rounded"
                placeholder="Objeto / Descripción"
                value="<?php echo isset($_POST['process_event']) ? $_POST['object_description'] : ''; ?>">
          </div>
          <div>
              <label for="user" class="label-input">Comprador</label>
              <input type="text"
                id="user"
                name="user"
                class="input-field-process-rounded"
                placeholder="Responsable Evento"
                value="<?php echo isset($_POST['process_event']) ? $_POST['user'] : ''; ?>">
          </div>
          <div>
            <label for="status_id" class="label-input">Estado</label>
            <select id="status_id" name="status_id" class="input-field-process-rounded">
              <option value=""
                selected="<?php echo (isset($_POST['status_id']) && $_POST['status_id'] == "") ?>">Todos</option>
              <?php
                if (isset($statuses)) {
                  while ($status = $statuses->fetch()) { ?>
                    <option value="<?php echo $status['id'] ?>"
                      <?php echo (isset($_POST['status_id']) && (int) $_POST['status_id'] == (int) $status['id']) ? "selected='selected'" : "" ?>>
                      <?php echo $status['name'] ?>
                    </option>
              <?php
                  }
                }
              ?>
            </select>
          </div>
      </div>

      <div class="grid gap-6 mb-6 grid-cols-3">
        <div></div>
        <div></div>
        <div class="grid gap-6 mb-6 grid-cols-2">
          <button type="submit" name="btn_search" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
          <button type="submit" name="btn_excel" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Generar Excel</button>
        </div>

      </div>
    </form>

    <?php if (isset($process_events)) { ?>
      <div class="flex justify-end text-gray-500 mb-2">
        <p>Número de procesos / eventos listados: <span class="font-semibold"><?php echo $process_events->rowCount() ?></span></p>
      </div>

      <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="p-4">
                    #
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Objeto
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Descripción
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Fecha Inicio
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Fecha Cierre
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Estado
                  </th>
                  <th scope="col" class="py-3 px-6">
                    Responsable del evento
                  </th>
                  <!-- <th scope="col" class="py-3 px-6">
                    Acciones
                  </th> -->
                </tr>
            </thead>
            <tbody>
              <?php
                if (isset($process_events)) {
                  while ($process_event = $process_events->fetch()) { ?>
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4 w-4">
                      <?php echo $process_event['id']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['object']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['description']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['start_date']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['end_date']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['status']; ?>
                    </td>
                    <td class="py-4 px-6">
                      <?php echo $process_event['user']; ?>
                    </td>
                  </tr>
              <?php
                  }
                }
              ?>
            </tbody>
        </table>
      </div>
      <?php
        } else {
      ?>
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
          Por favor elija los criterios de búsqueda necesarios para filtrar y haga clic en buscar, si desea ver todos los procesos solo haga clic en buscar
        </div>
      <?php } ?>
  </div>

<?php include 'templates/footer.php'; ?>