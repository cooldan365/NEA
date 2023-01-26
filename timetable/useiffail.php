<?php
session_start(); // Start a new session or resume an existing one
$usrname = $_SESSION['uid'];
$newFileName = $usrname  . '.' . 'csv';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  /* Add some styling for the timetable */
  table {
    border-collapse: collapse;
    width: 100%;
  }
  td, th {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
  }
  th {
    background-color: lightgray;
  }
  .highlight {
    background-color: yellow;
  }
</style>

<table id="timetable">
  <tr>
    <th></th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th></th>
  </tr>
  <tr>
    <td>9:00am</td>
    <td><input type="text" name="monday-9am"></td>
    <td><input type="text" name="tuesday-9am"></td>
    <td><input type="text" name="wednesday-9am"></td>
    <td><input type="text" name="thursday-9am"></td>
    <td><input type="text" name="friday-9am"></td>
    <td><button class="delete-button">Delete</button></td>
  </tr>
</table>
<br>
<!--button to allow the user to add another time slot -->
<button id="add-time-button">Add Time</button>
<br><br>
<input type="submit" value="Save">

<!--JavaScript function to handle form submission and to delete rows when the delete button is clicked -->
<script>
    // Add an event listener for the "Add Time" button to add a new row to the table
    const addTimeButton = document.querySelector("#add-time-button");
    addTimeButton.addEventListener("click", function() {
    // Add a new row to the table for the additional time slot
    const table = document.querySelector("#timetable");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td><input type="text" name="time"></td>
        <td><input type="text" name="monday"></td>
        <td><input type="text" name="tuesday"></td>
        <td><input type="text" name="wednesday"></td>
        <td><input type="text" name="thursday"></td>
        <td><input type="text" name="friday"></td>
        <td><button class="delete-button">Delete</button></td>
    `;
    table.appendChild(newRow);
    //  event listeners for the delete buttons
    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
        // Delete the corresponding row when the delete button is clicked
        const row = deleteButton.parentElement.parentElement;
        row.remove();
        });
    });
    });
    //  event listeners for the form submission and table cells to save the timetable data and highlight cells when hovered over
    const form = document.querySelector("#timetable-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
    // Add code here to save the form data (e.g., using local storage or an AJAX request)

    });
    const tableCells = document.querySelectorAll("#timetable td");
    tableCells.forEach(function(cell) {
    cell.addEventListener("mouseenter", function() {
        cell.classList.add("highlight");
    });
    cell.addEventListener("mouseleave", function() {
        cell.classList.remove("highlight");
    });
    });
    form.addEventListener("submit", function(event) {
    event.preventDefault();
    // Convert the timetable data into a CSV file
    const rows = document.querySelectorAll("#timetable tr");
    let csvContent = "";
    rows.forEach(function(row) {
    const cells = row.querySelectorAll("td, th");
    let rowData = "";
    cells.forEach(function(cell) {
        rowData += cell.textContent + ",";
    });
    csvContent += rowData + "\r\n";
    });
    // Save the CSV file onto the local desktop with the PHP session "usrname
    const csvBlob = new Blob([csvContent], {type: "text/csv"});
    const link = document.createElement("a");
    link.href = window.URL.createObjectURL(csvBlob);
    link.download = `timetable-${usrname}.csv`;
    link.click();
    console.log(link);
    });
    const cells = row.split(",");
    if (cells.length > 1) { // Skip empty rows
    // Adds a new row to the table for the saved time slot, if necessary
    let time = cells[0];
    let monday = cells[1];
    let tuesday = cells[2];
    let wednesday = cells[3];
    let thursday = cells[4];
    let friday = cells[5];
    if (i >= rows.length - 2) { // Check if the current row is the last row
    const table = document.querySelector("#timetable");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td><input type="text" name="time" value="${time}"></td>
        <td><input type="text" name="monday" value="${monday}"></td>
        <td><input type="text" name="tuesday" value="${tuesday}"></td>
        <td><input type="text" name="wednesday" value="${wednesday}"></td>
        <td><input type="text" name="thursday" value="${thursday}"></td>
        <td><input type="text" name="friday" value="${friday}"></td>
        <td><button class="delete-button">Delete</button></td>
    `;
    table.appendChild(newRow);
    //  event listeners for the delete buttons
    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
        // Delete the corresponding row when the delete button is clicked
        const row = deleteButton.parentElement.parentElement;
        row.remove();
        });
    });
    } else {
    // Update the existing row with the saved data
    const rows = document.querySelectorAll("#timetable tr");
    const cells = rows[i].querySelectorAll("td input");
    cells[0].value = time;
    cells[1].value = monday;
    cells[2].value = tuesday;
    cells[3].value = wednesday;
    cells[4].value = thursday;
    cells[5].value = friday;
    }
    }

</script>


</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    /* Add some styling for the timetable */
    table {
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }
    th {
        background-color: lightgray;
    }
    .highlight {
        background-color: yellow;
    }
    </style>

    <table id="timetable">
    <tr>
        <th></th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th></th>
    </tr>
    <tr>
        <td>9:00am</td>
        <td><input type="text" name="monday-9am"></td>
        <td><input type="text" name="tuesday-9am"></td>
        <td><input type="text" name="wednesday-9am"></td>
        <td><input type="text" name="thursday-9am"></td>
        <td><input type="text" name="friday-9am"></td>
        <td><button class="delete-button">Delete</button></td>
    </tr>
    </table>
    <br>
    <!--button to allow the user to add another time slot -->
    <button id="add-time-button">Add Time</button>
    <br><br>
    <input type="submit" value="Save">
    <input type="file" id="file-input" accept=".csv">
    <button id="open-button">Open Timetable</button>


<script>
    // Get the table element
    var table = document.getElementById("timetable");

    // Get the "Add Time" button element
    var addTimeButton = document.getElementById("add-time-button");

    // Add an event listener for the "Add Time" button
    addTimeButton.addEventListener("click", function() {
        // Get the new time from user input
        var newTime = prompt("Enter the new time:");
        if (newTime != null) {
            // Create a new row element
            var newRow = table.insertRow();

            // Create cells for the new row
            var timeCell = newRow.insertCell();
            var mondayCell = newRow.insertCell();
            var tuesdayCell = newRow.insertCell();
            var wednesdayCell = newRow.insertCell();
            var thursdayCell = newRow.insertCell();
            var fridayCell = newRow.insertCell();
            var deleteCell = newRow.insertCell();

            // Add content to the cells
            timeCell.innerHTML = newTime;
            mondayCell.innerHTML = "<input type='text' name='monday-newtime'>";
            tuesdayCell.innerHTML = "<input type='text' name='tuesday-newtime'>";
            wednesdayCell.innerHTML = "<input type='text' name='wednesday-newtime'>";
            thursdayCell.innerHTML = "<input type='text' name='thursday-newtime'>";
            fridayCell.innerHTML = "<input type='text' name='friday-newtime'>";
            deleteCell.innerHTML = "<button class='delete-button'>Delete</button>";

            // Add event listener for the new delete button
            var newDeleteButton = deleteCell.querySelector(".delete-button");
            newDeleteButton.addEventListener("click", function() {
                // Check if table have at least one row
                if (table.rows.length > 2) {
                    table.deleteRow(newRow.rowIndex);
                } else {
                    alert("At least one row is required!");
                }
            });
        }
    });

    // Add event listeners for the existing delete buttons
    var deleteButtons = document.getElementsByClassName("delete-button");
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener("click", function() {
            // Check if table have at least one row
            if (table.rows.length > 2) {
                var rowToDelete = this.parentNode.parentNode;
                table.deleteRow(rowToDelete.rowIndex);
            } else {
                alert("At least one row is required!");
            }
        });
    }
    // Add an event listener to the "Save" button
    var saveButton = document.querySelector("input[value='Save']");
    saveButton.addEventListener("click", saveTimetable);
     // Function to save the timetable to a CSV file
    function saveTimetable() {
        // Get the rows of the table
        var rows = table.rows;

        // Create an array to store the data
        var data = [];

        // Loop through the rows and get the data
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].cells;
            var time = cells[0].innerText;
            var monday = cells[1].querySelector("input[name='monday-newtime']").value;
            var tuesday = cells[2].querySelector("input[name='tuesday-newtime']").value;
            var wednesday = cells[3].querySelector("input[name='wednesday-newtime']").value;
            var thursday = cells[4].querySelector("input[name='thursday-newtime']").value;
            var friday = cells[5].querySelector("input[name='friday-newtime']").value;

            // Add the data to the array
            data.push({
                time: time,
                monday: monday,
                tuesday: tuesday,
                wednesday: wednesday,
                thursday: thursday,
                friday: friday
            });
        }

        // Convert the data to a CSV string
        var csvContent = "Time,Monday,Tuesday,Wednesday,Thursday,Friday\n";
        data.forEach(function(row) {
            csvContent += row.time + "," + row.monday + "," + row.tuesday + "," + row.wednesday + "," + row.thursday + "," + row.friday + "\n";
        });

        // Create a Blob to save the data
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Create a link to download the data
        var link = document.createElement("a");
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", newFileName);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        }

</script>
</body>
</html>



function savetimetable(filename) {
        var rows = document.querySelectorAll("table tr");
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].querySelector('input').value);
            }

            csv.push(row.join(","));
    }

    // Download CSV file
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv.join("\n")], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
        }
    });


</script>
