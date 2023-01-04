function addActivity(user_id) {
    // Get form data
    var day = document.getElementById('day').value;
    var activity = document.getElementById('activity').value;
    var time = document.getElementById('time').value;

    // Create POST request
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    // Update timetable table
    var timetable = JSON.parse(this.responseText);
    var table = document.getElementById('timetable');
    for (var i = 0; i < timetable.length; i++) {
        var row = table.insertRow(-1);
        var dayCell = row.insertCell(0);
        var activityCell = row.insertCell(1);
        var timeCell = row.insertCell(2);
        dayCell.innerHTML = timetable[i].day;
        activityCell.innerHTML = timetable[i].activity;
        timeCell.innerHTML = timetable[i].time;
        }
    }
    };
    xhttp.open("POST", "add_activity.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("day=" + day + "&activity=" + activity + "&time=" + time + "&user_id=" + user_id);
}
