const tabElements = [
    {
        id: 'basic-info',
        triggerEl: document.querySelector('#basic-info-tab'),
        targetEl: document.querySelector('#basic-info')
    },
    {
        id: 'schedule',
        triggerEl: document.querySelector('#schedule-tab'),
        targetEl: document.querySelector('#schedule')
    },
    {
        id: 'documentation',
        triggerEl: document.querySelector('#documentation-tab'),
        targetEl: document.querySelector('#documentation')
    }
];

// options with default values
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const tabActive = urlParams.get('tab') != null ? urlParams.get('tab') : 'basic-info';
console.log(tabActive);

const options = {
    defaultTabId: tabActive,
    activeClasses: 'text-indigo-light hover:text-indigo-light dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        console.log('tab is shown');
    }
};

const tabs = new Tabs(tabElements, options);


const btnSearchActivity = document.querySelector("#btn-search-activity");
btnSearchActivity.addEventListener('click', async function () {
    const searchActivity = document.querySelector('#search-activity');
    searchActivity.classList.remove("field-error");

    try {
        const activities = await getActivities();
        const foundActivities = document.querySelector('#found-activities');
        if (activities == undefined || activities.length == 0) {
            foundActivities.innerHTML = `
                <div class="mt-7 p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                    <span class="font-medium">Sin resultados!</span> Debe ingresar una palabra para buscar la actividad.
                </div>
            `
        } else {
            let strHtml = '<div class="activities-container overflow-y-auto">';
            activities.forEach((activity) => {
                strHtml += `
                    <div class="flex items-center mb-4 ml-2 pt-2">
                        <input id="activity-${activity.code}" type="radio" value="${activity.code}" name="activity" class="radio-field radio-activity" required>
                        <label for="activity-${activity.code}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">${activity.name}</label>
                    </div>
                `;
            });
            strHtml += "</div>";

            foundActivities.innerHTML = strHtml;
        }
    } catch (e) {
        console.log(e);
    }
    return false;
});

const btnSubmitActivity = document.querySelector('.btn-submit');
btnSubmitActivity.addEventListener('click', function (e) {
    const searchActivity = document.querySelector('#search-activity');
    const radioButtonsActivity = document.querySelector('.radio-activity');

    if (radioButtonsActivity == null) {
        searchActivity.classList.add("field-error");
        e.preventDefault();
    } else {
        searchActivity.classList.remove("field-error");
    }
})

async function getActivities() {
    const searchActivity = document.querySelector('#search-activity');
    const searchWord = searchActivity.value;

    if (searchWord != "") {
        let res = await getActivitiesWithFetch(searchWord);
        return res;
    } else {
        return [];
    }
}

async function getActivitiesWithFetch(q) {
    let res = await fetch('asynchronous/process.php?q=' + q)
    return res.json()
}