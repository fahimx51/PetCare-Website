<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Care Admin Dashboard</title>
  <link rel="stylesheet" href="admin_dashbord.css">
</head>
<body>
<div class="sidebar">
  <div class="logo">
    <h1><span>Pet</span>&nbsp;Care</h1>
  </div>
  <ul class="nav">
    <li><a href="#" onclick="loadContent('reg_users.php')">Registered Users</a></li>
    <li><a href="#" onclick="loadContent('temp_user.php')">Pending Users</a></li>
    <li><a href="#" onclick="loadContent('pets.php')">Pets</a></li>
    <li><a href="#" onclick="loadContent('pet_food.php')">Pet Food</a></li>
    <li><a href="#" onclick="loadContent('appointment.php')">Pending Appointments</a></li>
    <li><a href="#" onclick="loadContent('approved_appointments.php')">Approved Appointment</a></li>
  </ul>
</div>
<button onclick="logout()" class="logout-button">Logout</button>

<div class="content">
  <div class="main-content" id="mainContent">
    <div class="cards-container">
      <div class="card">
        <div class="card-header">
          Registered Users
        </div>
        <div class="card-body" id="registeredUsersCount"></div>
      </div>

      <div class="card">
        <div class="card-header">
          Pending Users
        </div>
        <div class="card-body" id="otherUsersCount"></div>
      </div>

      <div class="card">
        <div class="card-header">
          Pending Appointments
        </div>
        <div class="card-body" id="pendingAppointmentsCount"></div>
      </div>

      <div class="card">
        <div class="card-header">
          Approved Appointments
        </div>
        <div class="card-body" id="approvedAppointmentsCount"></div>
      </div>
    </div>
  </div>
</div>

<script>
  function loadContent(page) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("mainContent").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", page, true);
    xhttp.send();
  }

  function fetchRegisteredUsersCount() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("registeredUsersCount").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "get_registered_users_count.php", true);
    xhttp.send();
  }

  function fetchOtherUsersCount() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("otherUsersCount").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "get_other_users_count.php", true);
    xhttp.send();
  }

  function fetchPendingAppointmentsCount() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pendingAppointmentsCount").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "get_pending_appointments_count.php", true);
    xhttp.send();
  }

  function fetchApprovedAppointmentsCount() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("approvedAppointmentsCount").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "get_approved_appointments_count.php", true);
    xhttp.send();
  }

  window.onload = function() {
    fetchRegisteredUsersCount();
    fetchOtherUsersCount();
    fetchPendingAppointmentsCount();
    fetchApprovedAppointmentsCount();
  };

  function logout() {
    window.location.href = "../profile/login.html";
  }
</script>

</body>
</html>
