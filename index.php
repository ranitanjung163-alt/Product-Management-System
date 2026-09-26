<?php
session_start();
require_once 'db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$q = trim($_GET['q'] ?? '');
$filter_category = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($q)) {
    $sql .= " AND (name LIKE :q OR category LIKE :q)";
    $params['q'] = "%$q%";
}

if (!empty($filter_category)) {
    $sql .= " AND category = :cat";
    $params['cat'] = $filter_category;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = ['Elektronik', 'Aksesoris', 'Pakaian', 'Makanan'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Product Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Katalog Produk</h1>
        <a href="create.php" class="btn"> + Tambah Produk Baru</a>

        <form method="GET" action="index.php" style="margin-top: 15px; display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Cari nama produk...">
            
            <select name="category">
                <option value="">-- Semua Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>" <?= $filter_category === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filter & Cari</button>
            <?php if ($q || $filter_category): ?>
                <a href="index.php" style="align-self: center;">Reset</a>
            <?php endif; ?>
        </form>

        <div class="card-grid">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $p): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="category">Kategori: <?= htmlspecialchars($p['category'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                        <p class="stock">Stok: <?= (int)$p['stock'] ?></p>
                        
                        <div class="card-actions">
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn-edit">Edit</a>
                            
                            <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="margin-top:20px;">Belum ada produk yang sesuai.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
        </div>
    </div>
</body>
</html>