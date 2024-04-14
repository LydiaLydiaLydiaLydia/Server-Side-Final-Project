let depTimes = [];
let makeButtonsWork = function(){
    let buttons = document.getElementsByClassName("chooseTick");
    let depTDs = document.getElementsByClassName("depTime");
    for(i = 0; i < buttons.length; i++){
        buttons[i].addEventListener("click", chooseTicket, false);
        depTimes[i] = depTDs[i].innerHTML;
    }
}
let chooseTicket = function(e){
    console.log(this.id);
    document.getElementById("ticketDetails").style.display = "inline";
    document.getElementById("time").innerHTML = depTimes[this.id];
    let depTime = document.getElementById("departureTime");
    depTime.value = depTimes[this.id];
    depTime.innerText = depTimes[this.id];
    //document.getElementById("time").value = depTimes[this.id];
    //document.getElementById("vehicle").innerHTML = document.getElementById("vehicleTypes");
}