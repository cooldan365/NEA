// Array to store the timetable data
var timetable = [];
    
// Function to add an activity to the timetable
function addActivity() {
    // Get the form input
    let dataInput = document.getElementById("vals");
    let activity = document.getElementById('activity').value;
    let startTime = document.getElementById('start-time').value;
    let endTime = document.getElementById('end-time').value;
    console.log(activity);
    console.log(startTime);
    console.log(endTime);
    //make elements for each value to be inputs for the database
    let activities = document.createElement("input");
    activities.setAttribute("id", "description");
    activities.setAttribute("class", "description");
    activities.setAttribute("type", "text");
    activities.setAttribute("name", "activity");
    activities.setAttribute("value", activity);
    activities.setAttribute("readonly", "readonly");

    let timeStart = document.createElement("input");
    timeStart.setAttribute("id", "description");
    timeStart.setAttribute("class", "description");
    timeStart.setAttribute("type", "time");
    timeStart.setAttribute("name", "start-time");
    timeStart.setAttribute("value", startTime);
    timeStart.setAttribute("readonly", "readonly");

    let timeEnd = document.createElement("input");
    timeEnd.setAttribute("id", "description");
    timeEnd.setAttribute("class", "description");
    timeEnd.setAttribute("type", "time");
    timeEnd.setAttribute("name", "start-time");
    timeEnd.setAttribute("value", startTime);
    timeEnd.setAttribute("readonly", "readonly");

    dataInput.appendChild(activities);
    dataInput.appendChild(timeStart);
    dataInput.appendChild(timeEnd);

    // Add the activity to the timetable array
    timetable.push({activity: activity, startTime: startTime, endTime: endTime});

    // Add a new row to the table with the activity data
    var table = document.getElementById("timetable");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = activity;
    cell2.innerHTML = startTime;
    cell3.innerHTML = endTime;

    // Clear the form input
    document.getElementById('activity').value = "";
    document.getElementById('start-time').value = "";
    document.getElementById('end-time').value = "";
    
    
    }

