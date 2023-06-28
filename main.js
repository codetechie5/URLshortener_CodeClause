document.getElementById("shorten-form").addEventListener("submit", function(event) {
    event.preventDefault();
    var originalUrl = document.getElementById("original-url").value;

    // Send AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "shorten.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var shortenedUrl = response.shortenedUrl;
            document.getElementById("shortened-url").innerHTML = "Shortened URL: <a href='" + shortenedUrl + "'>" + shortenedUrl + "</a>";
        }
    };
    xhr.send("url=" + encodeURIComponent(originalUrl));
});
