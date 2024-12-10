// @ts-nocheck
import { selectedDay } from "./initCalendar";

document.getElementById("btnAddPeriod").addEventListener("click", () => {
    const notificationModal = document.getElementById("notificationModal");
    const notificationMessage = document.getElementById("notificationMessage");
    const selectedDateInput = document.getElementById("selectedDateInput");
    const today = new Date();
    const monthNames = [
        "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];
    const selectedDate = new Date(today.getFullYear(), today.getMonth(), selectedDay);
    const selectedDayText = `${selectedDate.getDate()} de ${monthNames[selectedDate.getMonth()]}`;

    notificationMessage.textContent = `¿Estás segura de registrar tu periodo en este día (${selectedDayText})?`;
    selectedDateInput.value = `${selectedDate.toISOString().split("T")[0]}`;

    notificationModal.showModal();
});

document.getElementById("cancelPeriodButton").addEventListener("click", () => {
    const notificationModal = document.getElementById("notificationModal");
    notificationModal.close();
});

document.getElementById("confirmPeriodForm").addEventListener("submit", () => {
    const notificationModal = document.getElementById("notificationModal");
    const actualSituation = document.getElementById("actual-situation");
    const restantDays = document.getElementById("restant-days");
    const changeText = document.getElementById("change-text");
    const btnAddPeriod = document.getElementById("btnAddPeriod");

    actualSituation.textContent = "Actualizando información";
    restantDays.textContent = "Espera un momento...";
    btnAddPeriod.style.display = "none";
    changeText.style.display = "none";

    notificationModal.close();
});
