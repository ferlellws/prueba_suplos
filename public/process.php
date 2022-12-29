<?php include 'templates/header.php'; ?>

<?php include 'templates/banner.php'; ?>

<?php include 'controllers/process_controller.php'; ?>


<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
  <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500
  dark:text-gray-400" id="tab" role="tablist">
    <li class="mr-2" role="presentation">
      <button class="button-tab"
        id="basic-info-tab"
        type="button"
        role="tab"
        aria-controls="basic-info"
        aria-current="page"
        aria-selected="false">
          Información básica
      </button>
    </li>
    <li class="mr-2" role="presentation">
      <button class="button-tab"
        id="schedule-tab"
        type="button"
        role="tab"
        aria-controls="schedule"
        aria-selected="false">
          Cronograma
      </button>
    </li>
    <li class="mr-2" role="presentation">
      <button class="button-tab"
        id="documentation-tab"
        type="button"
        role="tab"
        aria-controls="documentation"
        aria-selected="false">
          Documentación petición de oferta
      </button>
    </li>
  </ul>
</div>

<div id="tabContent">
  <div class="hidden p-4 dark:bg-gray-800" id="basic-info"
    role="tabpanel" aria-labelledby="basic-info-tab">
    <?php include 'templates/process_event.php'; ?>
  </div>

  <div class="hidden p-4 dark:bg-gray-800" id="schedule"
    role="tabpanel" aria-labelledby="schedule-tab">
      <?php include 'templates/schedule.php'; ?>
  </div>

  <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="documentation"
  role="tabpanel" aria-labelledby="documentation-tab">
    <?php include 'templates/documentation.php'; ?>
  </div>
</div>

<?php include 'templates/footer.php'; ?>