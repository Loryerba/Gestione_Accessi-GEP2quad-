function loadPage() {
    //Set min data, today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("meeting-time")[0].setAttribute('min', today);
}

function checkFields() {
    var c = false;

    //Get values from fields
    var meetingTime = document.getElementById("meeting-time").value;
    var name = document.getElementById("meeting-nameClient").value;
    var meetingObject = document.getElementById("meeting-object").value;
    var meetingDescription = document.getElementById("meeting-description").value;
    var meetingEmployee = document.getElementById("meeting-employee").value;
    var meetingEmailClient = document.getElementById("meeting-emailClient").value;

    //Check values

    if ((meetingTime == "") || (meetingTime == null)) {
        c = true;
    }

    if ((name == "") || (name == null)) {
        c = true;
    }

    if ((meetingObject == "") || (meetingObject == null)) {
        c = true;
    }

    if ((meetingDescription == "") || (meetingDescription == null)) {
        c = true;
    }

    if ((meetingEmployee == "") || (meetingEmployee == null)) {
        c = true;
    }

    if ((meetingEmailClient == "") || (meetingEmailClient == null)) {
        c = true;
    }

    //Final check
    if (c) {
        //There are some errors
        alert("Attenzione, ha inserito in modo errato alcuni valori");
        return false;
    }
}