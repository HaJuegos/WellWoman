// @ts-nocheck
import { calculateCycle, ciclo } from "./initCalendar";

const btnFullCalendar = document.getElementById("btnFullCalendar");
const fullCalendar = document.getElementById("fullCalendar");
const btnCloseCalendar = document.getElementById("btnCloseCalendar");
const fullCalendarGrid = document.querySelector(".full-calendar-grid");

document.addEventListener("DOMContentLoaded", () => {
    btnFullCalendar.addEventListener("click", () => {
        generateFullCalendar();
        fullCalendar.style.display = "flex";
        document.body.style.overflow = "hidden";
    });

    btnCloseCalendar.addEventListener("click", () => {
		fullCalendar.classList.add("fade-out");
		
		setTimeout(() => {
			fullCalendar.style.display = "none";
			document.body.style.overflow = "auto";
			fullCalendar.classList.remove("fade-out");
		}, 400);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key == "Escape") {
            fullCalendar.classList.add("fade-out");
		
			setTimeout(() => {
				fullCalendar.style.display = "none";
				document.body.style.overflow = "auto";
				fullCalendar.classList.remove("fade-out");
			}, 400);
        };
    });
});

/**
 * Funcion que genera todo el calendario completo con indicaciones del ciclo menstrual.
 * @returns {Void}
 */
function generateFullCalendar() {
    fullCalendarGrid.innerHTML = "";

    const currentYear = new Date().getFullYear();
    const tooltipTexts = {
        period: (day) => `Inicio del periodo: Día ${day}`,
        ovulation: (day) => `Ovulación: Día ${day}`,
        fertile: (day) => `Fértil: Día ${day}`
    };
    const titleElement = document.getElementById("full-calendar-title");

    for (let month = 0; month < 12; month++) {
        const monthElement = document.createElement("div");
        const monthTitle = document.createElement("h3");
        const weekDays = ["D", "L", "M", "X", "J", "V", "S"];
        const daysInMonth = new Date(currentYear, month + 1, 0).getDate();
        const firstDayOfWeek = new Date(currentYear, month, 1).getDay();

        monthElement.className = "full-calendar-month";
        monthTitle.textContent = new Date(currentYear, month).toLocaleString("es-ES", { month: "long" });
        monthElement.appendChild(monthTitle);

        weekDays.forEach(day => {
            const dayHeader = document.createElement("div");

            dayHeader.textContent = day;
            dayHeader.className = "day-header";
            monthElement.appendChild(dayHeader);
        });

        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDay = document.createElement("div");

            emptyDay.className = "full-calendar-day-empty";
            monthElement.appendChild(emptyDay);
        };

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(currentYear, month, day);
            const rawCycleDay = calculateCycle(date);
            const cycleDay = ((rawCycleDay % ciclo.cycleDuration) + ciclo.cycleDuration) % ciclo.cycleDuration;
            const dayElement = document.createElement("div");

            dayElement.className = "full-calendar-day";
            dayElement.textContent = day;

            if (cycleDay <= ciclo.menstruateDuration) {
                dayElement.classList.add("period-day");
                dayElement.setAttribute("data-tooltip", tooltipTexts.period(day));
            } else if (cycleDay == ciclo.cycleDuration - ciclo.lutealFaseDuration) {
                dayElement.classList.add("ovulation-day");
                dayElement.setAttribute("data-tooltip", tooltipTexts.ovulation(day));
            } else if (cycleDay > ciclo.menstruateDuration && cycleDay < ciclo.cycleDuration - ciclo.lutealFaseDuration) {
                dayElement.classList.add("fertile-day");
                dayElement.setAttribute("data-tooltip", tooltipTexts.fertile(day));
            };

            if (cycleDay > ciclo.cycleDuration - ciclo.lutealFaseDuration && cycleDay <= ciclo.cycleDuration) {
                dayElement.classList.add("ovulation-day");
                dayElement.setAttribute("data-tooltip", tooltipTexts.ovulation(day));
            };

            monthElement.appendChild(dayElement);
        };

        const totalCells = 42;

        while (monthElement.children.length < totalCells) {
            const emptyDay = document.createElement("div");
            emptyDay.className = "full-calendar-day-empty";
            monthElement.appendChild(emptyDay);
        };

        fullCalendarGrid.appendChild(monthElement);
    };

    titleElement.textContent = `Calendario Menstrual ${new Date().getFullYear()}`;
};
