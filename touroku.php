<!DOCTYPE html>
<html lang="jan">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
</head>
<body>
    <h1>登録ページ</h1>
<form action="write.php" method="post" enctype="multipart/form-data">
    名前：<input type="text" name="name" required><br>
    Email:<input type="email" name="email" required><br>
    パスワード:<input type="password" name="password" required><br>
    所属会社:<input type="text" name="company"><br>
    役職:<input type="text" name="position"><br>
    備考:<textarea name="memo" cols="30" rows="10"></textarea><br>
    写真:<input type="file" name="photo" accept="image/*"><br>
    <button type="submit">登録</button>
</form>

</body>
</html>