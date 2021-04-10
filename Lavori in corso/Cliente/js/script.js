//Function called to get values and check them
function checkField() {
    //Get values from fields
    var meetingDate = document.getElementById("meeting-date").value;
    var meetingTime = document.getElementById("meeting-time").value;
    var name = document.getElementById("meeting-nameClient").value;
    var meetingObject = document.getElementById("meeting-object").value;
    var meetingEmployee = document.getElementById("meeting-employee").value;
    var meetingEmailClient = document.getElementById("meeting-emailClient").value;

    //Check all values from the form
    if ((meetingDate == "") || (meetingDate == null)) {
        //Missing something
        messageError();
        return false;
    }

    if ((meetingTime == "") || (meetingTime == null)) {
        //Missing something
        messageError();
        return false;
    }

    if ((name == "") || (name == null)) {
        //Missing something
        messageError();
        return false;
    }

    if ((meetingObject == "") || (meetingObject == null)) {
        //Missing something
        messageError();
        return false;
    }

    if ((meetingEmployee == "") || (meetingEmployee == null)) {
        //Missing something
        messageError();
        return false;
    }

    if ((meetingEmailClient == "") || (meetingEmailClient == null)) {
        //Missing something
        messageError();
        return false;
    } else {
        //Check email format
        if (!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(myForm.meetingEmailClient.value))) {
            //Error format
            messageError();
            return false;
        }
    }
}

//Alert with error
function messageError() {
    window.alert("Attenzione, compila tutti i campi");
}