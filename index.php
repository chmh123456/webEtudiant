<?php
include "db.php";

$msg = "";
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c9e9ff;
            margin: 0;
            padding: 0;
        }


        .navbar {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #5bb8ff, #c9e9ff);
            display: flex;
            justify-content: center;
            gap: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #003d66;
        }

        .container {
            width: 75%;
            margin: auto;
            background: white;
            padding: 25px;
            margin-top: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.25);
        }


        #search {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #7fbde9;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(to right, #89ccff, #c9e9ff);
            color: #003d66;
        }

        table, th, td {
            border: 1px solid #7fbde9;
        }

        td, th {
            padding: 12px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            background: #5bb8ff;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3c9fde;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding: 15px;
            background: linear-gradient(to right, #c9e9ff, #5bb8ff);
            color: #003d66;
            font-weight: bold;
        }

        
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #5bb8ff;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            opacity: 0;
            transform: translateY(-20px);
            transition: 0.5s;
            font-weight: bold;
        }
    </style>

    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this student?");
        }

        function searchStudent() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll("#studentTable tr");

            rows.forEach(row => {
                let name = row.querySelector("td:nth-child(2)")?.textContent.toLowerCase();
                let classCell = row.querySelector("td:nth-child(3)")?.textContent.toLowerCase();
                if ((name && name.includes(input)) || (classCell && classCell.includes(input))) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function showToast(msg){
            let t = document.getElementById("toast");
            t.innerHTML = msg;
            t.style.opacity = "1";
            t.style.transform = "translateY(0)";

            setTimeout(()=>{
                t.style.opacity = "0";
                t.style.transform = "translateY(-20px)";
            }, 3000);
        }
    </script>
</head>

<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add.php">Add Student</a>
    </div>

    <?php if($msg){ ?>
    <script> showToast("<?= $msg ?>"); </script>
    <?php } ?>

    <div class="container">
        <h2 style="text-align:center; color:#003d66;">Student List</h2>

        <input type="text" id="search" placeholder="Search student or class..." onkeyup="searchStudent()">

        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>

            <tbody id="studentTable">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM students");
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['class']}</td>
                    <td>
                        <a class='btn' href='edit.php?id={$row['id']}'>Edit</a>
                        <a class='btn' href='delete.php?id={$row['id']}' onclick='return confirmDelete()'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <footer>
        Student Management System - SEM3
    </footer>

    <div id="toast" class="toast"></div>

</body>
</html>
