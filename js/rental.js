
let startDateInput = document.getElementById('start-date');
let endDateInput = document.getElementById('end-date');
let numDays = document.getElementById('num-days');
let now = new Date();
let startDatePicker = new Litepicker({
    element: startDateInput,
    format: 'DD MMM YYYY',
    singleMode: true,
    showTooltip: true,
    scrollToDate: true,
    startDate: new Date(now).setDate(now.getDate()),
    minDate: new Date(now).setDate(now.getDate()),
    maxDate: "12/30/2023",
    setup: function (picker) {
        picker.on('selected', function (date) {
            let nextDay = new Date(date.getTime() + (24 * 60 * 60 * 1000));
            endDatePicker.setOptions({
                minDate: nextDay,
                startDate: nextDay
            });
            updateDays();
        });
    }
});

let endDatePicker = new Litepicker({
    element: endDateInput,
    format: 'DD MMM YYYY',
    singleMode: true,
    showTooltip: true,
    scrollToDate: true,
    startDate: new Date(now).setDate(now.getDate() + 1),
    minDate: new Date(now).setDate(now.getDate() + 1),
    maxDate: "12/31/2023",
    setup: function (picker) {
        picker.on('selected', function (date) {
            updateDays();
        });
    }
});

function updateDays() {

    let startDate = startDatePicker.getDate();
    let endDate = endDatePicker.getDate();
    if (startDate && endDate) {
        let timeDiff = endDate.getTime() - startDate.getTime();
        let dayDiff = Math.round(timeDiff / (1000 * 3600 * 24));
        total_price = dayDiff * price;
        if (dayDiff == 1) {
            document.getElementById("day-diff").innerHTML = dayDiff + " day rate";
        }
        else {
            document.getElementById("day-diff").innerHTML = dayDiff + " days rate";
        }
        document.getElementById("price1").innerHTML = 'THB ' + total_price.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        document.getElementById("price2").innerHTML = 'THB ' + total_price.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
}
startDatePicker.on('selected', updateDays);
endDatePicker.on('selected', updateDays);

const timeSelect1 = document.getElementById("time-picker1");
for (let hour = 0; hour < 24; hour++) {
    for (let minute = 0; minute < 60; minute += 30) {
        let timeValue = `${hour.toString().padStart(2, "0")}:${minute.toString().padStart(2, "0")}`;
        let displayText = `${hour.toString().padStart(2, "0")}:${minute.toString().padStart(2, "0")}`;
        let option = document.createElement("option");
        option.value = timeValue;
        option.text = displayText;
        timeSelect1.appendChild(option);
    }
}
timeSelect1.value = "10:00";

const timeSelect2 = document.getElementById("time-picker2");
for (let hour = 0; hour < 24; hour++) {
    for (let minute = 0; minute < 60; minute += 30) {
        let timeValue = `${hour.toString().padStart(2, "0")}:${minute.toString().padStart(2, "0")}`;
        let displayText = `${hour.toString().padStart(2, "0")}:${minute.toString().padStart(2, "0")}`;
        let option = document.createElement("option");
        option.value = timeValue;
        option.text = displayText;
        timeSelect2.appendChild(option);
    }
}
timeSelect2.value = "10:00";

const timePicker1 = document.getElementById("time-picker1");
const timePicker2 = document.getElementById("time-picker2");

timePicker1.addEventListener("change", function () {
    timePicker2.value = timePicker1.value;
});

timePicker2.addEventListener("change", function () {
    timePicker1.value = timePicker2.value;
});

// const openPopupButton = document.getElementById("open-popup");
// const closePopupButton = document.getElementById("close-popup");
// const popupContainer = document.getElementById("popup-container");
// const body = document.getElementsByTagName("body")[0];

// openPopupButton.addEventListener("click", () => {
//     popupContainer.style.display = "block";
//     body.style.overflow = "hidden";
// });

// closePopupButton.addEventListener("click", () => {
//     popupContainer.style.display = "none";
//     body.style.overflow = "auto";
// });

document.getElementById("card-select").addEventListener("change", function() {
  if (this.value === "new_card") {
    document.getElementById("new-card-fields3").style.display = "block";
    document.getElementById("new-card-fields2").style.display = "none";
  } else {
    document.getElementById("new-card-fields3").style.display = "none";
    document.getElementById("new-card-fields2").style.display = "block";
  }
});



