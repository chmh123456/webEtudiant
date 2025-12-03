<?php include "db.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
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
<h2>Edit Student</h2>
<form method="POST">
<input type="text" name="name" value="<?= $data['name'] ?>" required>
<input type="text" name="class" value="<?= $data['class'] ?>" required>
<button type="submit">Update</button>
</form>
</div>

</body>
</html>

<?php
if($_POST){
    $name = $_POST['name'];
    $class = $_POST['class'];
    mysqli_query($conn, "UPDATE students SET name='$name', class='$class' WHERE id=$id");
    header("Location: index.php?msg=Student updated!");
}
?>
