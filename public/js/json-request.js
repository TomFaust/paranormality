
function sendJSON() {
    event.preventDefault();
    let id = event.target.id
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    let xhr = new XMLHttpRequest();
    let url = "/ajax-request";

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