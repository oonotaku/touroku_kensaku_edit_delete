<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];

    $sql = "SELECT * FROM registrations WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: edit.php');
        exit;
    } else {
        echo "ログイン情報が正しくありません。";
    }
}
?>

<form method="post" action="login.php">
    Email:<input type="email" name="email" required><br>
    パスワード:<input type="password" name="password" required><br>
    <button type="submit">ログイン</button>
</form>
