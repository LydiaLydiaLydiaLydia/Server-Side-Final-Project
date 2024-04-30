let activateVButton = function(){
    let addButton = document.getElementById("submit");
    addButton.addEventListener("click", validateVehicles, false);
}

let validateVehicles = function(e){
    
    let price = document.getElementById("price").value;

    price = Number(price);
    if(!(price >= 1 && price <= 99.99)){
        alert("Price must be less than 99.99 and greater than 0.");
        e.preventDefault();
    }
    
}