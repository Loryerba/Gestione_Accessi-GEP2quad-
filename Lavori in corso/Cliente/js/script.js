function loadPage() {
    //Set min data, today
    var today = new Date().toISOString().split('T')[0];
    today += "T00:00";
    document.getElementsByName("meeting-time")[0].setAttribute('min', today);
}

function checkField() {
    //Get values from fields
    var meetingTime = document.getElementById("meeting-time").value;
    var name = document.getElementById("meeting-nameClient").value;
    var meetingObject = document.getElementById("meeting-object").value;
    var meetingEmployee = document.getElementById("meeting-employee").value;
    var meetingEmailClient = document.getElementById("meeting-emailClient").value;

    //Check values
    if ((meetingTime == "") || (meetingTime == null)) {
        messageError();
        return false;
    }

    if ((name == "") || (name == null)) {
        messageError();
        return false;
    }

    if ((meetingObject == "") || (meetingObject == null)) {
        messageError();
        return false;
    }

    if ((meetingEmployee == "") || (meetingEmployee == null)) {
        messageError();
        return false;
    }

    if ((meetingEmailClient == "") || (meetingEmailClient == null)) {
        messageError();
        return false;
    } else {
        if (!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(myForm.meetingEmailClient.value))) {
            messageError();
            return false;
        }
    }
}

function messageError() {
    alert("Attenzione, controlla i campi inseriti");
}