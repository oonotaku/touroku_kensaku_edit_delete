<?php
require 'auth.php'; // ログインチェック
require 'db.php'; // データベース接続

// セッションが開始されていない場合はセッションを開始
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ログインユーザーの情報を取得
if (isset($_SESSION['user_id'])) {
    echo '<a href="edit.php">自分の情報を編集する</a>';
} else {
    echo '<a href="login.php">ログインしてください</a>';
}

// 検索キーワードを取得
$keyword = htmlspecialchars($_GET['keyword'] ?? '', ENT_QUOTES, 'UTF-8');

// SQLクエリを動的に生成
$sql = "SELECT name, photo_path, company FROM registrations";
$params = [];

if (!empty($keyword)) {
    $sql .= " WHERE company LIKE :keyword"; // 所属会社で部分一致検索
    $params[':keyword'] = '%' . $keyword . '%';
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録一覧</title>
        <nav>
            <a href="index.php">登録一覧</a>
            <a href="logout.php">ログアウト</a>
        </nav>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            display: inline-block;
            width: 200px;
            text-align: center;
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>登録一覧</h1>

    <!-- 検索フォーム -->
    <form method="get" action="index.php">
        <input type="text" name="keyword" placeholder="会社名で検索" value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">検索</button>
    </form>

    <div class="cards">
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <div class="card">
                    <a href="detail.php?name=<?php echo urlencode($row['name']); ?>">
                        <img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    </a>
                    <p><?php echo htmlspecialchars($row['company']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>該当するデータがありません。</p>
        <?php endif; ?>
    </div>
</body>
</html>
