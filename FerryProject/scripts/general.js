let comboBoxSelected = function(selectedItem) {
    console.log(selectedItem);
    document.getElementById(selectedItem).setAttribute('selected', 'selected');
}
let hideButton = function(buttonid){
    let mySubmit = document.getElementById(buttonid);
    mySubmit.style.display = "none";
}