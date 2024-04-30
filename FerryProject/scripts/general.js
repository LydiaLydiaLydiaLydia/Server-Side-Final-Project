let comboBoxSelected = function(selectedItem) {
    console.log(selectedItem);
    document.getElementById(selectedItem).setAttribute('selected', 'selected');
}
let hideButton = function(){
    let mySubmit = document.getElementById('submit');
    mySubmit.style.display = "none";
}