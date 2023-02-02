
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable, Studify</title>
    <link rel="stylesheet" href="../styles/timetable.css">
</head>
<body>
    <table id="timetable">
    <!-- defining the table header names -->
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
        <!-- defining the row of the first table  -->
        <td>9:00am</td>
        <td><input type="text" name="monday-9am"></td>
        <td><input type="text" name="tuesday-9am"></td>
        <td><input type="text" name="wednesday-9am"></td>
        <td><input type="text" name="thursday-9am"></td>
        <td><input type="text" name="friday-9am"></td>
        <!-- placed the delete button in the table so it is know which row will be deleteed if the button is clicked -->
        <td><button class="delete-button">Delete</button></td>
    </tr>
    </table>
    <br>
    <!--button to allow the user to add another time slot -->
    <button id="add-time-button">Add Time</button>
    <br><br>
    <input type="submit" value="Save">
    

<script>
    // Get the details in the timetable elemnt in the html 
    var table = document.getElementById("timetable");

    // Creates a variable in js for the add time 
    var addTimeButton = document.getElementById("add-time-button");

    // Add an event listener for the "Add Time" button, and performs a function for when the add button is clicked
    addTimeButton.addEventListener("click", function() {
        // a host message will be displayed prompting the user to input a time 
        var newTime = prompt("Enter the new time:");
        if (newTime != null) {
            // Create a new row element to insert into the HTML 
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
            //as the delete button is in the table, it too will be generated when there is a new row being added
            deleteCell.innerHTML = "<button class='delete-button'>Delete</button>";

            //assigns the new delete button created within the add button function 
            var newDeleteButton = deleteCell.querySelector(".delete-button");
            newDeleteButton.addEventListener("click", function() {
                // Check if table have at least 2 rows.
                if (table.rows.length > 2) {
                    //if the table rows is greater than 2 it can delete a row
                    table.deleteRow(newRow.rowIndex);
                } else {
                    //if not, the program tells the user that they cannot delete any more rows
                    alert("Unable to delete, one row must be present!");
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
                //inbuilt js funtion to completely remove the row
                table.deleteRow(rowToDelete.rowIndex);
            } else {
                alert("At least one row is required!");
            }
        });
    }

</script>
</body>
</html>