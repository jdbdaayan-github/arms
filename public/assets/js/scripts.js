//auto close success alert
setTimeout(function() {
    let alert = document.querySelector(".alert-success");
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500);
    }
}, 3000);




//DataTables

//DirectorateLists
$(document).ready( function () {
    $('#directoratelist').DataTable();
} );