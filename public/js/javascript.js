
function sendJSON() {
    event.preventDefault();
    let id = event.target.id
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    let xhr = new XMLHttpRequest();
    let url = "/json-request";

    xhr.open("POST", url, true);

    xhr.setRequestHeader("Content-Type", "application/json");

    var data = JSON.stringify({ "post": id,"_token": csrf });

    xhr.send(data);

    let likes = document.getElementById("likes" + id).textContent;

    likes = parseInt(likes,10)

    if(event.target.style.filter == "grayscale(100%)"){
        likes += 1;
        event.target.style.filter = "grayscale(0%)";
    }else{
        likes -= 1;
        event.target.style.filter = "grayscale(100%)";
    }

    document.getElementById("likes" + id).innerHTML = likes;
}

function setActive() {

    let id = event.target.id
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    let xhr = new XMLHttpRequest();
    let url = "/set-active";

    xhr.open("POST", url, true);

    xhr.setRequestHeader("Content-Type", "application/json");

    var data = JSON.stringify({ "post": id,"_token": csrf });

    xhr.send(data);

}

function deletePost() {

    let c = confirm("Are you sure you want to delete this post?")

    if(c == true) {

        let id = event.target.id
        let csrf = document.querySelector('meta[name="csrf-token"]').content;

        let xhr = new XMLHttpRequest();
        let url = "/delete-post";

        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-Type", "application/json");

        var data = JSON.stringify({"post": id, "_token": csrf});

        xhr.send(data);

        location.reload();
    }
}

function previewFile() {
    var preview = document.querySelector('img');
    var file    = document.querySelector('input[type=file]').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

function deleteUser() {

    let c = confirm("Are you sure you want to delete this post?")

    if(c == true) {

        let id = event.target.id
        let csrf = document.querySelector('meta[name="csrf-token"]').content;

        let xhr = new XMLHttpRequest();
        let url = "/delete-user";

        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-Type", "application/json");

        var data = JSON.stringify({"post": id, "_token": csrf});

        xhr.send(data);

        location.reload();
    }

}
