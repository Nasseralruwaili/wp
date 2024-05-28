// JavaScript for navigating to different pages based on the dropdown selection
function navigateTo(value) {
    if (value) {
        window.location.href = value;
    }
}

// JavaScript for form validation (if needed)
function validateForm() {
    var hikeName = document.getElementById("hikeName").value;
    var description = document.getElementById("description").value;
    var image = document.getElementById("image").value;
    var imageCaption = document.getElementById("imageCaption").value;
    var distance = document.getElementById("distance").value;
    var location = document.getElementById("location").value;
    var level = document.getElementById("level").value;

    if (!hikeName || !description || !image || !imageCaption || !distance || !location || !level) {
        alert("All fields are required!");
        return false;
    }
    return true;
}
