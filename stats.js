// Log current URL
console.log("Current URL:", window.location.href);

// Log history URL
console.log("History URL:", document.referrer);

// Log IP address and country using the ipapi.co API
var ipRequest = new XMLHttpRequest();
ipRequest.open("GET", "https://ipapi.co/json/", true);
ipRequest.onload = function () {
  if (ipRequest.status >= 200 && ipRequest.status < 400) {
    var data = JSON.parse(ipRequest.responseText);
    var ip = data.ip;
    console.log("IP Address:", ip);
    var country = data.country_name;
    console.log("Country:", country);

    // Prepare the data to be sent
    var requestData = {
      currentURL: window.location.href,
      historyURL: document.referrer,
      ipAddress: ip,
      country: country,
    };

    // Send the data to stats.php
    var statsRequest = new XMLHttpRequest();
    // statsRequest.open("POST", "receive_stats.php", true);
    statsRequest.open("POST", "https://s.fgp.one/receive_stats.php", true);
    statsRequest.setRequestHeader("Content-Type", "application/json");
    statsRequest.onload = function () {
      if (statsRequest.status >= 200 && statsRequest.status < 400) {
        console.log("Data sent successfully");
      } else {
        console.error("Error sending data:", statsRequest.statusText);
      }
    };
    statsRequest.onerror = function () {
      console.error("Error sending data:", statsRequest.statusText);
    };
    statsRequest.send(JSON.stringify(requestData));
  } else {
    console.error("Error fetching IP address and country:", ipRequest.statusText);
  }
};
ipRequest.onerror = function () {
  console.error("Error fetching IP address and country:", ipRequest.statusText);
};
ipRequest.send();

// Log click events on the <a> tags
var links = document.querySelectorAll("a");
links.forEach(function (link) {
  link.addEventListener("click", function (event) {
    console.log("Link clicked:", link.href);
    // Prevent the default behavior of the link
    event.preventDefault();
    // Add your custom logic here for when a link is clicked
  });
});
