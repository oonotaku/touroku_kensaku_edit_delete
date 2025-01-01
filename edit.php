<?php
session_start();
require 'auth.php'; // ログインチェック
require 'db.php';

// ログイン中のユーザーのID
$userId = $_SESSION['user_id'] ?? null;

// 管理者が他のユーザーを編集する場合
if (isset($_GET['id']) && isAdmin()) {
    $userId = $_GET['id'];
}

// ユーザーIDがない場合、不正なアクセスと判断
if (!$userId) {
    echo "不正なアクセスです。ログインしてください。";
    exit;
}

// データベースから該当ユーザーの情報を取得
$sql = "SELECT * FROM registrations WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "データが見つかりません。";
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($_POST['company'], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST['position'], ENT_QUOTES, 'UTF-8');
    $memo = htmlspecialchars($_POST['memo'], ENT_QUOTES, 'UTF-8');

    // 写真アップロード処理
    $photoPath = $user['photo_path']; // デフォルトは既存のパスを使用
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileNameCmps = explode(".", $_FILES['photo']['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $_FILES['photo']['name']) . '.' . $fileExtension;
        $uploadFileDir = './uploaded_photos/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $photoPath = $dest_path;

            // 古い画像を削除
            if (file_exists($user['photo_path'])) {
                unlink($user['photo_path']);
            }
        } else {
            echo "画像の保存に失敗しました。";
            exit;
        }
    }

    // データベース更新
    $sql = "UPDATE registrations 
            SET name = :name, company = :company, position = :position, memo = :memo, photo_path = :photo_path 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':company' => $company,
        ':position' => $position,
        ':memo' => $memo,
        ':photo_path' => $photoPath,
        ':id' => $userId
    ]);

    echo "情報が更新されました！<br>";
    echo '<a href="index.php">登録一覧ページに戻る</a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報編集</title>
</head>
<body>
    <h1>情報編集</h1>

    <form method="post" action="edit.php<?php echo isset($_GET['id']) ? '?id=' . htmlspecialchars($_GET['id']) : ''; ?>" enctype="multipart/form-data">
        名前：<input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
        所属会社：<input type="text" name="company" value="<?php echo htmlspecialchars($user['company']); ?>"><br>
        役職：<input type="text" name="position" value="<?php echo htmlspecialchars($user['position']); ?>"><br>
        備考：<textarea name="memo"><?php echo htmlspecialchars($user['memo']); ?></textarea><br>
        
        現在の写真：<br>
        <?php if (!empty($user['photo_path'])): ?>
            <img src="<?php echo htmlspecialchars($user['photo_path']); ?>" alt="現在の写真" style="max-width: 200px; max-height: 200px;"><br>
        <?php else: ?>
            <p>写真が登録されていません。</p>
        <?php endif; ?>
        
        写真を変更：<input type="file" name="photo" accept="image/*"><br>
        
        <button type="submit">更新</button>
    </form>
    <p><a href="index.php">登録一覧に戻る</a></p>
    <p><a href="logout.php">ログアウト</a></p>
</body>
</html>
