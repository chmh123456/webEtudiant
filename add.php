<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
<style>
body { font-family: Arial; background:#c9e9ff; }
.box {
    width: 40%; margin: auto; margin-top: 60px;
    background: white; padding: 20px;
    border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
input, button {
    width: 100%; padding: 10px; margin-top: 10px;
}
button {
    background:#5bb8ff; color:white; border:none; border-radius:5px;
}
button:hover { background:#3c9fde; }
</style>
</head>
<body>

<div class="box">
<h2>Add Student</h2>
<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="text" name="class" placeholder="Class (e.g., SEM3A)" required>
<button type="submit">Save</button>
</form>
</div>

</body>
</html>

<?php
if($_POST){
    $name = $_POST['name'];
    $class = $_POST['class'];
    mysqli_query($conn, "INSERT INTO students (name, class) VALUES ('$name', '$class')");
    header("Location: index.php?msg=Student added!");
}
?>
