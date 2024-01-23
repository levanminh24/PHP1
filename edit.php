<?php
require "function.php";
require "connect.php";

$sql = "SELECT * FROM `genres`";
$data = $connect->query($sql);
$listAir = $data->fetchAll();

$ID = $_GET['id'];
$sql = "SELECT * FROM `movies` WHERE `movie_id` = $ID";
$data = $connect->query($sql);
$airEdit = $data->fetch(); // Sử dụng fetch() thay vì fetchAll() vì chỉ cần một bản ghi

if (isset($_POST['btn_edit'])) {
    //$checkUp= false;
    $ups="uploads/";
    $up_names=basename($_FILES['poster']['name']);
    $upFile=$ups.$up_names;
    if(move_uploaded_file($_FILES['poster']['tmp_name'],$upFile)){
        $checkUp=true;
    }
    $title=$_POST['title'];
    if($checkUp==true){
    $poster=$upFile;
    } else{
        $poster=$airEdit['poster'];
    }
    $overview=$_POST['overview'];
    $release_date=$_POST['release_date'];
    $genre_id=$_POST['genre_id']; 

    $sql = "UPDATE `movies` SET `title`='{$title}', `poster`='{$poster}', `overview`='{$overview}', `release_date`='{$release_date}', `genre_id`='{$genre_id}' WHERE `movies`.`movie_id`={$ID}";
    $connect->exec($sql);
    header("location:list.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin bộ phim</title>
</head>

<body>
    <h1>Chỉnh sửa thông tin bộ phim</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Tên bộ phim</label>
        <input type="text" name="title" id="title" value="<?php echo $airEdit['title']; ?>"><br><br>

        <label for="poster">Ảnh bộ phim</label>
        <input type="file" name="poster" id="poster"><br><br>
        <label for="overview">Mô tả bộ phim</label>
        <input type="text" name="overview" id="overview" value="<?php echo $airEdit['overview']; ?>"><br><br>
        <label for="release_date">Ngày phát hành</label>
        <input type="date" name="release_date" value="<?php echo $airEdit['release_date']; ?>"><br><br>

        <label for="genre_id">Thể loại</label>
        <select name="genre_id" id="genre_id">
            <option value="">-- Chọn --</option>
            <?php foreach ($listAir as $Air) : ?>
            <option value="<?php echo $Air['genre_id']; ?>"
                <?php echo ($airEdit['genre_id'] == $Air['genre_id']) ? 'selected' : ''; ?>>
                <?php echo $Air['genre_name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" name="btn_edit" value="Cập nhật">
    </form>
</body>

</html>