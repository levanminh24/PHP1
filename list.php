<?php
require "connect.php";
require "function.php";
$sql = "SELECT * FROM `genres` as g INNER JOIN `movies` as m on g.genre_id=m.genre_id";
$data = $connect->query($sql);
$listPro = $data->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phim</title>
    <style>
    table tr th {
        border-bottom: 3px solid red;
        padding: 7px 20px;
    }

    table tr td {
        border-bottom: 1px solid red;
        padding: 7px 20px;
    }
    </style>
</head>

<body>
    <?php if (isset($_COOKIE['username'])) : ?>
    Xin chào: <b><?php echo $_COOKIE['username']; ?></b>
    <?php endif; ?>

    <h1>Danh sách bộ phim</h1>
    <a href="add.php">Thêm mới</a>
    <table>
        <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>ảnh phim</th>
            <th>Mô tả</th>
            <th>Ngày phát hành</th>
            <th>Thể loại</th>
            <th>Thao tác</th>
        </tr>
        <?php
        $stt = 0;
        foreach ($listPro as $pro) {
            $stt++;
        ?>
        <tr>
            <td> <?php echo $stt ?></td>
            <td><?php echo $pro['title'] ?></td>
            <td><img src="<?php echo $pro['poster'] ?>" alt="" width="250px" height="160px"></td>
            <td><?php echo $pro['overview'] ?></td>
            <td><?php echo $pro['release_date'] ?></td>
            <td><?php echo $pro['genre_name'] ?></td>
            <td> <a href="delete.php?id=<?php echo $pro['movie_id'] ?> ">Xoá</a> | <a
                    href="edit.php?id=<?php echo $pro['movie_id'] ?>">sửa</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>