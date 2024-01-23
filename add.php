<?php
require "function.php";
require "connect.php";
$sql = "SELECT * FROM `genres`";
$data = $connect->query($sql);
$listAir = $data->fetchAll();

if (isset($_POST['btn_add'])) {
    $ups = "uploads/";
    $up_names = basename($_FILES['poster']['name']);
    $upFile = $ups . $up_names;
    move_uploaded_file($_FILES['poster']['tmp_name'], $upFile);
    $title = $_POST['title'];
    $poster = $upFile;
    $overview = $_POST['overview'];
    $release_date = $_POST['release_date'];
    $genre_id = $_POST['genre_id'];
    $sql = "INSERT INTO `movies`(`movie_id`, `title`, `poster`, `overview`, `release_date`, `genre_id`) VALUES (null, '{$title}', '{$poster}', '{$overview}', '{$release_date}', '{$genre_id}')";
    $connect->exec($sql);
    header("location:list.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới bộ phim</title>
</head>

<body>
    <h1>Thêm mới</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Tên bộ phim</label>
        <input type="text" name="title" id=""><br><br>

        <label for="poster">Ảnh bộ phim</label>
        <input type="file" name="poster" id=""><br><br>

        <label for="overview">Mô tả bộ phim</label>
        <input type="text" name="overview" id=""><br><br>

        <label for="release_date">Ngày phát hành</label>
        <input type="date" name="release_date" id=""><br><br>

        <label for="genre_id">Thể loại</label>
        <select name="genre_id" id="">
            <option value="">--Chọn--</option>
            <?php foreach ($listAir as $Air) : ?>
            <option value="<?php echo $Air['genre_id'] ?>"><?php echo $Air['genre_name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" name="btn_add" value="Thêm mới">
    </form>
</body>

</html>