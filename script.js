// script.js
//
// Description: JavaScript file to connect and disconnect to the database.
// Author: Joshua Hontanosas

function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "get-data.php?q=" + str, true);
        xmlhttp.send();
    }
}

//Preloads website with the year 2012
window.onload = function() {
    showUser('2012');
}