<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインまたは登録</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ようこそ！</h1>
        <button class="button" onclick="location.href='login.php'">ログイン</button>
        <button class="button" onclick="location.href='touroku.php'">新規登録</button>
    </div>
</body>
</html>
