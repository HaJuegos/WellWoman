// @ts-nocheck
export const ciclo = {
    lastPeriod: cycleData.lastPeriod ? new Date(cycleData.lastPeriod) : null,
    cycleDuration: cycleData.cycle_duration || 0,
    lutealFaseDuration: cycleData.luteal_phase || 0,
    menstruateDuration: cycleData.period_duration || 0,
    sleepHours: cycleData.sleep_hours || 0,
    waterIntake: cycleData.water_intake || 0,
    stepGoal: cycleData.step_goal || 0,
    desiredWeight: cycleData.desired_weight || 0,
    desiredHeight: cycleData.desired_height || 0,
    calorieIntake: cycleData.calorie_intake || 0,
    pregnancyProbability: cycleData.pregnancy_probability || false
};

let currentSlide = 0;
export let selectedDay = null;

document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    const todayIndex = today.getDay();
    const daysHeader = document.querySelector(".calendar-days-header").children;
    const actionText = document.getElementById("actionText");
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const calendarDays = document.querySelectorAll('.calendar-day');

    Array.from(daysHeader).forEach((dayElement, index) => {
        if (index == todayIndex) {
            dayElement.textContent = "Hoy";
        };
    });

    selectedDay = today.getDate();
    setActualDayTitle();
    setDaysInCalendar();
    highlightSelectedDay(today.getDate());
    updateStatus();
    showActionText();

    document.getElementById("prevButton").addEventListener("click", () => {
        slideCalendar(-1);
    });

    document.getElementById("nextButton").addEventListener("click", () => {
        slideCalendar(1);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key == "ArrowRight") slideCalendar(1);
        if (event.key == "ArrowLeft") slideCalendar(-1);
    });

    document.getElementById('calendarGrid').addEventListener('click', (event) => {
        let target = event.target;

        if (target.tagName == "P" && target.parentElement.classList.contains('calendar-day')) {
            target = target.parentElement;
        };

        if (target.classList.contains('calendar-day')) {
            const day = parseInt(target.textContent);

            selectedDay = day;
            highlightSelectedDay(day);
            updateStatus();
        };
    });

    document.getElementById("calendarGrid").addEventListener("mouseover", (event) => {
		if (event.target.closest(".calendar-day")) {
			prevButton.style.left = '-35px';
			nextButton.style.right = '-35px';
		};
	});

	document.getElementById("calendarGrid").addEventListener("mouseout", (event) => {
		if (event.target.closest(".calendar-day")) {
			prevButton.style.left = '10px';
			nextButton.style.right = '10px';
		};
	});
});

/**
 * Desplazamiento de los días del calendario
 * @param {number} direction Dirección a desplazarse.
 * @returns {void}
 */
function slideCalendar(direction) {
    const calendarGrid = document.getElementById("calendarGrid");
    const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
    const visibleDays = 7;
    const maxSlide = Math.ceil(daysInMonth / visibleDays) - 1;

    currentSlide += direction;
    if (currentSlide < 0) currentSlide = 0;
    if (currentSlide > maxSlide) currentSlide = maxSlide;

    const offset = -currentSlide * 100;
    calendarGrid.style.transform = `translateX(${offset}%)`;
};

/**
* Animacion para el texto que sale diciendo que se pueden usar las flechas del teclado.
* @returns {Void}
*/
function showActionText() {
    setTimeout(() => {
        actionText.style.opacity = 1;
        actionText.style.transform = "translate(-47.5%, 32%)";

        setTimeout(() => {
            actionText.style.opacity = 0;
            actionText.style.transform = "translate(-47.5%, 0%)";
        }, 2500);
    }, 1000);
};

/**
 * Función para cambiar el título al día actual.
 * @returns {void}
 */
function setActualDayTitle() {
    const titleElement = document.getElementById("actual-day");
    const today = new Date();
    const monthNames = [
        "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];

    titleElement.textContent = `${today.getDate()} de ${monthNames[today.getMonth()]} del ${today.getFullYear()}`;
}

/**
 * Función para calcular el día actual en el ciclo.
 * @param {Date} todayDate La fecha a calcular del ciclo.
 * @returns {number} El día actual del ciclo.
 */
export function calculateCycle(todayDate = new Date()) {
    const diff = todayDate - ciclo.lastPeriod;
    const totalDays = Math.floor(diff / (1000 * 60 * 60 * 24));

    return (((totalDays % ciclo.cycleDuration) + ciclo.cycleDuration) % ciclo.cycleDuration);
}

/**
 * Función para añadir los días al calendario con deslizamiento.
 * @returns {void}
 */
function setDaysInCalendar() {
    const calendarElement = document.getElementById("calendarGrid");
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfWeek = new Date(year, month, 1).getDay();
    const prevMonthDays = new Date(year, month, 0).getDate();

    calendarElement.innerHTML = "";

    for (let i = firstDayOfWeek - 1; i >= 0; i--) {
        const emptyElement = document.createElement("div");

        emptyElement.className = "calendar-day-empty";
        emptyElement.textContent = prevMonthDays - i;
        calendarElement.appendChild(emptyElement);
    };

    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement("div");
        const dayText = document.createElement("p");

        const rawCycleDay = calculateCycle(new Date(year, month, day));
        const cycleDay = (((rawCycleDay % ciclo.cycleDuration) + ciclo.cycleDuration) % ciclo.cycleDuration);

        dayElement.className = "calendar-day";
        dayText.textContent = day;

        if (cycleDay >= 0 && cycleDay <= ciclo.menstruateDuration) {
            dayElement.classList.add("period-day");
        };

        if (cycleDay == ciclo.cycleDuration - ciclo.lutealFaseDuration) {
            dayElement.classList.add("ovulation-day");
        };

        if (cycleDay > ciclo.menstruateDuration && cycleDay < ciclo.cycleDuration - ciclo.lutealFaseDuration) {
            dayElement.classList.add("fertile-day");
        };

        dayElement.appendChild(dayText);
        calendarElement.appendChild(dayElement);
    };

    const totalCells = Math.ceil((firstDayOfWeek + daysInMonth) / 7) * 7;

    for (let i = 1; calendarElement.children.length < totalCells; i++) {
        const dayElement = document.createElement("div");
        const dayText = document.createElement("p");

        dayElement.className = "calendar-day-empty";
        dayText.textContent = i;

        dayElement.appendChild(dayText);
        calendarElement.appendChild(dayElement);
    };
};

/**
 * Función para actualizar el estado del ciclo en el DOM.
 * @returns {void}
 */
function updateStatus() {
    const textSituationElement = document.getElementById('actual-situation');
    const textRestantDaysElement = document.getElementById('restant-days');
    const textChanceElement = document.getElementById('change-text');
    const cycleDay = calculateCycle(new Date(new Date().setDate(selectedDay)));
    const ovulationDay = ciclo.cycleDuration - ciclo.lutealFaseDuration;

    if (cycleDay <= ciclo.menstruateDuration) {
        textSituationElement.textContent = "Periodo:";
        textRestantDaysElement.textContent = `Día ${cycleDay + 1}`;
        textChanceElement.textContent = "";
    } else if (cycleDay < ovulationDay) {
        const daysToOvulation = ovulationDay - cycleDay;
        textSituationElement.textContent = "Ovulación en";
        textRestantDaysElement.textContent = `${daysToOvulation} día(s)`;
        textChanceElement.textContent = "Alta probabilidad de quedar embarazada";
    } else if (cycleDay == ovulationDay) {
        textSituationElement.textContent = "Predicción: día de";
        textRestantDaysElement.textContent = "Ovulación";
        textChanceElement.textContent = "Alta probabilidad de quedar embarazada";
    } else if (cycleDay <= ciclo.cycleDuration) {
        const daysToPeriod = ciclo.cycleDuration - cycleDay;
        textSituationElement.textContent = "Periodo en";
        textRestantDaysElement.textContent = `${daysToPeriod} día(s)`;
        textChanceElement.textContent = "Baja probabilidad de quedar embarazada";
    } else {
        textSituationElement.textContent = "Ciclo no calculable";
        textRestantDaysElement.textContent = "";
        textChanceElement.textContent = "";
    };
};

/**
 * Resalta el día seleccionado en el calendario.
 * @param {number} day El día a resaltar.
 * @returns {void}
 */
function highlightSelectedDay(day) {
    const calendarDays = document.querySelectorAll(".calendar-day");

    calendarDays.forEach(dayElement => {
        const dayNumber = parseInt(dayElement.textContent);

        if (dayNumber == day && !isNaN(dayNumber)) {
            dayElement.classList.add("selected-day");
        } else {
            dayElement.classList.remove("selected-day");
        }
    });
};
