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
    //query
    //$sql = "SELECT * FROM users WHERE username == $username AND password == $password"
    $stmt = $conn->prepare('SELECT * FROM classes where id_class in (SELECT id_class from attendance where status = "attend")');
    $stmt->execute();
    // Lấy danh sách kết quả
    $classes = $stmt->fetchAll();

    // Lấy tên giảng viên trong lớp
    $stmt_name_instructor = $conn->prepare('SELECT name FROM instructors where id_instructor in (SELECT id_instructor FROM classes)');
    $stmt_name_instructor->execute();
    $names = $stmt_name_instructor->fetchAll();

   // Lấy tên sinh viên đã điểm danh
   $stmt_name_student = $conn->prepare('SELECT name FROM students where id_sv in (SELECT id_sv FROM attendance WHERE status = "attend")');
   $stmt_name_student->execute();
   $sv_names = $stmt_name_student->fetchAll();
   
   // Lấy trạng thái điểm danh
   $stmt_status = $conn->prepare('SELECT status, day FROM attendance where id_sv in (SELECT id_sv FROM attendance WHERE status = "attend")');
    $stmt_status->execute();
    $status = $stmt_status->fetchAll();

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Điểm Danh</title>
     <!--Bootstrap-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h2 class="text-primary text-center text-uppercase">Kiểm tra thông tin điểm danh</h2>
    <div class="container">
<table class="table">
  <thead>
    <tr>
    <th scope="col">Mã Lớp</th>
      <th scope="col">Tên Lớp</th>
      <th scope="col">Tên giảng viên</th>
      <th scope="col">Ngày học</th>
      <th scope="col">Tên sinh viên</th>
      <th scope="col">Trạng thái điểm danh</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($classes as $class){
            foreach($names as $name){
                foreach($sv_names as $sv_name){
                    foreach($status as $statusCheck){
    ?>
            <tr>
                <th scope="row"><?= $class[0]; ?></th>
                <td><?= $class[2]; ?></td>
                <td><?= $name[0]; ?></td>
                <td><?= $statusCheck[1]; ?></td>
                <td><?= $sv_name[0]; ?></td>
                <td><?= $statusCheck[0]; ?></td>
            </tr>
    <?php
        }}}}
    ?>
  </tbody>
</table>
</div>
     <!--Script bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>