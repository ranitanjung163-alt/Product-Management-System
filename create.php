<?php
session_start();
require_once 'db.php';

$errors = [];
$name = $category = $price = $stock = '';
$categories = ['Elektronik', 'Aksesoris', 'Pakaian', 'Makanan'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price    = $_POST['price'] ?? '';
    $stock    = $_POST['stock'] ?? '';

    if (strlen($name) < 3) {
        $errors[] = "Nama produk minimal harus 3 karakter.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM products WHERE name = :name");
        $stmt->execute(['name' => $name]);
        if ($stmt->fetch()) {
            $errors[] = "Nama produk sudah digunakan (harus unik).";
        }
    }

    if (empty($category) || !in_array($category, $categories)) {
        $errors[] = "Pilih kategori yang valid.";
    }

    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Harga harus berupa angka dan bernilai lebih dari 0.";
    }

    if (!is_numeric($stock) || $stock < 0) {
        $errors[] = "Stok harus berupa angka dan bernilai minimal 0.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)");
        $stmt->execute([
            'name'     => $name,
            'category' => $category,
            'price'    => $price,
            'stock'    => $stock
        ]);

        header("Location: index.php?msg=success_add");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Produk Baru</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <?php foreach ($errors as $err): ?>
                    <p><?= htmlspecialchars($err) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="create.php" method="POST">
            <label>Nama Produk:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required><br><br>

            <label>Kategori:</label><br>
            <select name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>" <?= $category === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Harga:</label><br>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($price) ?>" required><br><br>

            <label>Stok:</label><br>
            <input type="number" name="stock" value="<?= htmlspecialchars($stock) ?>" required><br><br>

            <button type="submit">Simpan Produk</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
</body>
</html>