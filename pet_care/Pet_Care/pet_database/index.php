<?php
$conn = mysqli_connect("localhost", "root", "", "petcare");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $pet_type = mysqli_real_escape_string($conn, $_POST['pet_type']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $breed = mysqli_real_escape_string($conn, $_POST['breed']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    $sql = "INSERT INTO pets (pet_type, name, breed, age) VALUES ('$pet_type', '$name', '$breed', '$age')";
    if (mysqli_query($conn, $sql)) {
        $id = $conn->insert_id;
        echo "Pet added successfully!";
    } else {
        echo "Error adding pet: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM pets";
$result = mysqli_query($conn, $sql);
?>

<style>
    body{
        background-image: url('img/cute.png');
            background-size: cover;
            background-position: center;
            position: relative;
    }
  .pet-card {
    border: 2px solid #3498db;
    border-radius: 8px;
    margin: 10px;
    padding: 15px;
    display: inline-block;
    text-align: left;
    width: 300px;
    background-color: white;
  }

  .pet-card h3 {
    margin-bottom: 10px;
    color: black;
  }

  .pet-details p {
    margin: 5px 0;
  }

  .actions {
    margin-top: 10px;
  }

  .btn-update{

    background-color: #2ecc71;
    border-radius: 2px;
  }
  .btn-delete{
    background-color: red;
  }

  .add-pet-button {
    background-color: #2ecc71;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    
    align-items: center;
    text-decoration: none;
  }

  .add-pet-button img {
    margin-right: 10px;
  }

  .add-pet-button:hover {
    background-color: #27ae60;
  }


  .add-pet-button:focus {
    outline: none;
  }

  .add-pet-button:active {
    transform: translateY(2px);
  }

/* Modify nav styling to display inline and remove bullet points */
nav ul {
  list-style: none;
  background-color: #2ecc71 ;
  height: 50px;
  margin: 0;
  padding: 0;
  display: flex; /* Display elements horizontally */
}

nav li {
  padding: 10px;
  border-right: 1px solid #eee; /* Add borders between nav items */
}

nav li:last-child {
  border-right: none; /* Remove border on last item */
}

/* Style navigation links */
nav li a {
  text-decoration: none;
  text-align: center;
  color: #333;
  padding: 10px;
}

nav li a:hover {
  background-color: #ddd;
}

footer {
  background-color: #eee;
  padding: 20px;
  text-align: center;
}

footer p {
  margin-bottom: 10px;
}

footer ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

footer li {
  display: inline-block;
  padding: 5px;
}

footer li a {
  text-decoration: none;
  color: #333;
}

footer li a:hover {
  background-color: #ddd;
}

/* You can further adjust styles for hover effects, active states, etc. */


</style>
<title>Your Pet</title>
<link rel="shortcut icon" href="../home/image/logo.png" type="image/x-icon">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <nav>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Contact Us</a></li>
    <li><a href="#">Profile</a></li>
    <li><a href="#">Log Out</a></li>
  </ul>
</nav>

<h2>Pets List</h2>
<div class="actions">
  <a href="form.php" class="add-pet-button">
    <img src="../pet_database/img/plus-circle.svg" alt="Plus Circle Image">
    Add a Pet
  </a>
</div>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
  <div class="pet-card">
    <h3><?php echo $row['pet_type']; ?></h3>
    <div class="pet-details">
      <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
      <p><strong>Breed:</strong> <?php echo $row['breed']; ?></p>
      <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
    </div>
    <div class="actions">
      <button class="btn-update" onclick="window.location.href='update.php?id=<?php echo $row['id']; ?>'">Update</button>
      <button class="btn-delete" onclick="window.location.href='delete.php?id=<?php echo $row['id']; ?>'">Delete</button>
    </div>
  </div>
<?php endwhile; ?>

<?php
mysqli_close($conn);
?>

<footer>
    <p>&copy; Copyright 2024 Pet Care. All rights reserved.</p>
    <ul>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
  </footer>