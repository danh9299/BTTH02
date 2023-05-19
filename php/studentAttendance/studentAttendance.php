<?php
    // //$username = $_POST['username'] ?? '';
    // //$password = $_POST['password'] ?? '';
    // if(isset($_POST['username'])&&isset($_POST['password'])){
    //     echo $username;
    //     
    // 
    //     echo $password;}



    // Connect to database
    try {
        $conn = new PDO("mysql:host=localhost;dbname=btth02", 'root', '');
        echo "Connected to database: BTTH02 successfully.";
    } catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }

    $stmt_nameSV = $conn->prepare('SELECT id_sv,name from students where id_sv = 4');
    $stmt_nameSV->execute();
    // Lấy danh sách kết quả
    $names = $stmt_nameSV->fetchAll();
    //query
    //$sql = "SELECT * FROM users WHERE username == $username AND password == $password"

    //query classes
    //$sql

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm danh sinh viên</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <!--Title-->
    <h3 class="text-center text-uppercase text-primary">Điểm Danh Sinh Viên</h3>

    <!--Attendance-->
    <div class="container">
    <form action="" method="GET">
    <div class="mt-3 form-group">
        <label>Mã Sinh Viên</label>
            <input class="form-control" name="id_sv" value="<?= $names[0][0]; ?>" type="hidden" >
            <input class="form-control" name="" type="text" placeholder="<?= $names[0][0]; ?>" disabled = 'disabled'>
        </div>

    <div class="mt-3 form-group">
        <label>Tên Sinh Viên</label>
            <input class="form-control" name="name" type="hidden" value="<?= $names[0][1]; ?>">
            <input class="form-control" name="name" type="text" placeholder="<?= $names[0][1]; ?>" disabled = 'disabled'>
    </div>

    <div class="mt-3 form-group">
        <label for="exampleFormControlSelect1">Chọn lớp điểm danh</label>
            <select name="classname" class="form-control" id="exampleFormControlSelect1">
                <option>Công Nghệ Web</option>
                <option>Nền Tảng Phát Triển Web</option>
                <option>Lí Thuyết Tính Toán</option>
            </select>
    </div>
    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
    </div>


    <!--Navigate to the showInformationAttendance.php-->
    <div class="container mt-5">
        <div class="text-center">
            <a href="showInformationAttendance.php">Xem thông tin điểm danh</a>
        </div>
    </div>

    <!--Script bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>