<form method="post">
  <input type="hidden" name="step" value="">
  <div class="grid grid-cols-2 gap-6">
    <div>
        <label for="first_name"
          class="label-input">
          Objeto (*)
        </label>
        <input type="text"
          id="object"
          name="object"
          class="input-field-process-rounded"
          placeholder="Ingrese un objeto" required>
    </div>

    <div>
        <label for="search-activity"
          class="label-input">
          Actividad (*)
        </label>
        <div class="relative w-full">
            <input type="search"
              id="search-activity"
              class="input-field-process-rounded"
              placeholder="Busque la actividad">
            <div class="btn-search-inline"
              id="btn-search-activity">
                <svg aria-hidden="true"
                  class="w-5 h-5"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                    </path>
                </svg>
                <span class="sr-only">Search</span>
            </div>
        </div>
    </div>
  </div>

  <div class="grid grid-rows-2 grid-cols-2 gap-6 mt-3">
    <div>
      <label for="description"
        class="label-input">
        Descripción  / Alcance (*)
      </label>
      <textarea id="description"
        rows="4"
        name="description"
        class="text-area-field"
        placeholder="Ingrese la descripción / alcance"
        required></textarea>
    </div>

    <div class="row-span-2">
      <div id="found-activities"></div>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-3">
      <div>
        <label for="currency"
          class="label-input">
          Moneda (*)
        </label>
        <div class="flex">
          <span class="icon-field">
            <i class="fa-solid fa-list"></i>
          </span>
          <select id="currency"
            class="input-field-process"
            name="currency"
            required>
            <option value="">Elija una moneda</option>
            <option value="COP">COP</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
          </select>
        </div>
      </div>

      <div>
        <label for="budget"
          class="label-input">
          Presupuesto (*)
        </label>

        <div class="flex">
          <span class="icon-field">
            $
          </span>
          <input type="number"
            id="budget"
            name="budget"
            class="input-field-process"
            placeholder="Ingrese un valor"
            required>
        </div>
      </div>
    </div>
  </div>

  <hr />
  <div class="flex justify-center mt-6">
    <button type="submit" class="btn-submit">Guardar</button>
  </div>
</form>