<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start(); // Start a new session or resume an existing one
    $name = $_SESSION['uid'];
    if(isset($_POST['definedName']) && !empty($_POST['definedName'])) {
        $file_name_new = $name . $_POST['definedName'];
    } else {
        // Set a default file name if the definedName key is not set and is then saved
        $file_name_new = $name . 'default';
    }
    ?>
    <link rel="stylesheet" href="../styles/timetable.css">
</head>
    <form id="timetable-form" action="" method="post">
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
    <button id="add-time-button">Add Time</button>
    <br>
    <button onclick="savetimetable('<?php echo $file_name_new ?>')" type="submit" >Save TimeTable</button>
    </form>

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
        const row = deleteButton.closest('tr');
        if (row) {
            row.remove();
        }
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
    const form = document.querySelector("#timetable-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        // get the input values
        const inputs = document.querySelectorAll("#timetable input");
        // create an array to store the data
        const data = [];
        // loop through the inputs and get their values
        inputs.forEach(function(input) {
            data.push(input.value);
        });
        // convert the data array to a csv string
        const csv   Data = data.join(",");
        var formData = new FormData();
        formData.append("file", csvData);
        formData.append("filename", "<?php echo $file_name_new ?>");

        savetimetable(formData);
    });



    function savetimetable(formData) {
        var xhr = new XMLHttpRequest();
        // open the request
        xhr.open("POST", "upload.php");
        // send the request
        xhr.send(formData);
        // handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("TimeTable saved successfully!");
            } else {
                alert("Failed to upload the timetable.");
            }
        };
    }



</script>

