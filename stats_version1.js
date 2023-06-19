/*
<script src="https://s.fgp.one/stats.js"></script>
*/

document.addEventListener("DOMContentLoaded", function () {
  var url = window.location.href;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "https://s.fgp.one/server_side.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("URL sent to PHP successfully.");
    } else {
      console.log("Error sending URL to PHP.");
    }
  };

  xhr.send("url=" + encodeURIComponent(url));
});
