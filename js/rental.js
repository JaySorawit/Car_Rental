for (let i = 0; i < start_date.length; i++) {
    start_date[i] = start_date[i].substring(0, 10);
}
for (let i = 0; i < end_date.length; i++) {
    end_date[i] = end_date[i].substring(0, 10);
}
var disableDates = [];
for (var i = 0; i < start_date.length; i++) {
    disableDates.push({
        from: start_date[i],
        to: end_date[i]
    });
}

flatpickr("#date-picker", {
    mode: "range",
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: "2023.12.31",
    disable: disableDates,
    onChange: function (selectedDates, dateStr, instance) {
        let dateRangeInput = document.getElementById('date-picker').value;
        let dateRange = dateRangeInput.split(' to ');
        let startDate = new Date(dateRange[0]);
        let endDate = new Date(dateRange[1]);
        if (startDate && endDate) {
            let timeDiff = endDate.getTime() - startDate.getTime();
            let dayDiff = Math.round(timeDiff / (1000 * 3600 * 24));
            total_price = dayDiff * price;
            if (dayDiff == 1) {
                document.getElementById("day-diff").innerHTML = dayDiff + " day rate";
                document.getElementById("price1").innerHTML = 'THB ' + total_price.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                document.getElementById("price2").innerHTML = 'THB ' + total_price.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
            else if (dayDiff > 1) {
                document.getElementById("day-diff").innerHTML = dayDiff + " days rate";
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

    }

});


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

document.getElementById("card-select").addEventListener("change", function () {
    if (this.value === "new_card") {
        document.getElementById("new-card-fields3").style.display = "block";
        document.getElementById("new-card-fields2").style.display = "none";
    } else {
        document.getElementById("new-card-fields3").style.display = "none";
        document.getElementById("new-card-fields2").style.display = "block";
    }
});

function formatCreditCard() {
    var input = document.getElementById("card-number");
    var trimmed = input.value.replace(/\s+/g, "");
    var formatted = "";
    for (var i = 0; i < trimmed.length; i++) {
        if (i > 0 && i % 4 == 0) {
            formatted += " ";
        }
        formatted += trimmed.charAt(i);
    }
    input.value = formatted;
}

function formatCreditCard2() {
    var input = document.getElementById("new-card-number");
    var trimmed = input.value.replace(/\s+/g, "");
    var formatted = "";
    for (var i = 0; i < trimmed.length; i++) {
        if (i > 0 && i % 4 == 0) {
            formatted += " ";
        }
        formatted += trimmed.charAt(i);
    }
    input.value = formatted;
}

if (success) {
    window.onload = function () {
        document.getElementById('myPopup').style.display = 'block';
        document.body.style.overflow = 'hidden';
    };
}





