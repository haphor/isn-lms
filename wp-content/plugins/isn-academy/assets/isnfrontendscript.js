window.addEventListener("load", function () {
    // / Get the modal
    var modal = document.getElementById("certifiedModal");

    // Get the button that opens the modal
    var btn = document.getElementsByClassName("getCertificate");

    // Get the <span> element that closes the modal
    var spanBtn = document.getElementById("certificateModalClose");

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    if( spanBtn ){
        spanBtn.onclick = function () {
            modal.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
});
