//a lot of the content of the valdiation of the vehicles comes from the developer.mozilla
// article on Client-Side Form Validation
// link: https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation

window.onload = function(){
    let addButton = document.getElementById("submit");
    addButton.addEventListener("click", validateVehicles, false);
}

let validateVehicles = function(e){
    
    let vdescription = document.getElementById("vdescription").value;
    let vcode = document.getElementById("vcode").value;
    let price = document.getElementById("price").value;
    let units = document.getElementById("units").value;

    price = Number(price);
    console.log(price);
    e.preventDefault();
}