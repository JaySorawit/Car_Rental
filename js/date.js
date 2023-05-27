
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



