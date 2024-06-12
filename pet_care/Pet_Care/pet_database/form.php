<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care Form</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 100px;
            background-color: #f5f5f5;
            background-image: url('../home/image/pet1.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        form {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            margin: 0 auto;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

<form action="index.php" method="post">
    <h1>Pet Information</h1>
    <label for="pet_type">Pet Type:</label>
    <select name="pet_type">
        <option value="dog">Dog</option>
        <option value="cat">Cat</option>
    </select><br>

    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="breed">Breed:</label>
    <input type="text" name="breed" required><br>

    <label for="age">Age:</label>
    <input type="number" name="age" required><br>

    <input type="submit" name="submit" value="Add Pet">
</form>

</body>
</html>
