<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hello</title>
    <link rel="stylesheet" href="text.css">
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
      <h2>Mời bạn nhập</h2>
     <label for="ma">ID:</label>
     <input type="text" name="id" id="ma" value=""> <br>
     <label for="name">Name:</label>
     <input type="text" name="name" id="name" value=""> <br>
      <label for="sex">Sex:</label>
     <input type="text" name="sex" id="sex" value=""> <br>
       <label for="fileimg">Image</label>
     <input type="file" name="fileimg" id="fileimg" value=""> <br>    
     <button type="submit" name="submit">Save</button>
     <button type="submit" name="show">Show</button>
     <button type="submit" name="delete">Xóa</button> <!-- Thêm nút Xóa theo ID -->
    </form>
    <?php
      error_reporting(0);
      session_start();
      if(!isset($_SESSION['nhanvien']))
          $_SESSION['nhanvien'] = [];
      
      if(isset($_POST['submit'])){
          $manv = $_POST['id'];
          $name = $_POST['name'];
          $gioitinh = $_POST['sex'];
          $file = $_FILES['fileimg']['name']; // Sử dụng $_FILES để lấy thông tin tệp được tải lên

          if($manv != "" && $name != "" && $gioitinh != "" && $file != ""){
              $arr_nhanvien = [$manv, $name, $gioitinh, $file];
              $_SESSION['nhanvien'][] = $arr_nhanvien;
              echo "<script>alert('Dữ liệu đã được lưu vào mảng.')</script>";
          }
          else{
              echo "<script>alert('Vui lòng điền đủ thông tin.')</script>";
          }
      }

      if (isset($_POST['show'])) {
        echo "<form >";
        echo "<h2>Dữ liệu trong mảng:</h2>";
        echo "<ul>";
        foreach ($_SESSION['nhanvien'] as $nhanvien) {
            echo "<br><li>ID: $nhanvien[0]</li>";
            echo "<li>Name: $nhanvien[1]</li>";
            echo "<li>Sex: $nhanvien[2]</li>";
            echo "<li>Image: $nhanvien[3]</li><br>";
        }
        echo "</ul>";
        echo "</form>";
      }
    if (isset($_POST['delete'])) {
      $deleteID = $_POST['id'];
      if ($deleteID != "") {
          foreach ($_SESSION['nhanvien'] as $key => $nhanvien) {
              if ($nhanvien[0] == $deleteID) {
                  unset($_SESSION['nhanvien'][$key]);
                  echo "<script>alert('Dữ liệu với ID $deleteID đã được xóa.')</script>";
                  break; // Dừng việc duyệt nếu tìm thấy ID
              }
                 else{
                  echo "<script>alert('không tìm thấy ID vui lòng nhập lại ID.')</script>";
                 }
          }
      } else {
          echo "<script>alert('Vui lòng nhập ID để xóa.')</script>";
      }
  }
    ?>
</body>
</html>