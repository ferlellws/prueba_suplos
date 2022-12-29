<button type="button" data-modal-toggle="editUserModal" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 mb-3">
  <i class="fa-solid fa-plus"></i>
  Agregar contenido
</button>


<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="p-4">#</th>
          <th scope="col" class="py-3 px-6">Tipo</th>
          <th scope="col" class="py-3 px-6">Título</th>
          <th scope="col" class="py-3 px-6">Contenido</th>
          <th scope="col" class="py-3 px-6">Acciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
        $index = 1;
        if (isset($process_event_attachments)) {
          while ($process_event_attachment = $process_event_attachments->fetch()) { ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="p-4 w-4">
              <?php echo $index; ?>
            </td>
            <td class="py-4 px-6">
              <?php echo explode('/', $process_event_attachment['type_file'])[1]; ?>
            </td>
            <td class="py-4 px-6">
              <?php echo $process_event_attachment['title']; ?>
            </td>
            <td class="py-4 px-6">
              <?php echo $process_event_attachment['description']; ?>
            </td>
            <td class="py-4 px-6">
                <a href="show_file.php?process_event_attachment_id=<?php echo $process_event_attachment['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" target="_blank">Ver</a>
            </td>
          </tr>
      <?php
            $index++;
          }
        }
      ?>
    </tbody>
  </table>

  <div id="editUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-2xl h-full md:h-auto">
      <form method="post"
        class="relative bg-white rounded-lg shadow dark:bg-gray-700"
        enctype="multipart/form-data">
        <input type="hidden" name="step" value="documentation">
        <input type="hidden" name="process_event_id" value="<?php echo $_GET['process_event_id']; ?>">
        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Agregar Archivo
          </h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editUserModal">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
          </button>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="title" class="label-input">Título</label>
                    <input type="text" name="title" id="title" class="input-field-process-rounded" placeholder="Ingrese el título del archivo" required="">
                </div>
                <div class="col-span-6">
                    <label for="last-name" class="label-input">Descripción / Contenido</label>
                    <textarea name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describa el contenido del archivo" required=""></textarea>
                </div>
                <div class="col-span-6">
                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                  <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input"
                    type="file"
                    name="process_event_attachment"
                    required="">
                  <!-- <div class="flex items-center justify-center w-full">

                      <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600" id="drop_zone">
                          <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fa-solid fa-cloud-arrow-up fa-2xl mb-4 text-gray-400"></i>
                              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para adjuntar</span> o arrastre y suelte</p>
                          </div>
                          <input id="dropzone-file" name="process_event_attachment" type="file" class="hidden" required />
                      </label>
                  </div> -->

                </div>

            </div>
        </div>
        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar archivo</button>
        </div>
      </form>
    </div>
  </div>
</div>