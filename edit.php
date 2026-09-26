<?php
session_start();
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan.");
}

$errors = [];
$name     = $product['name'];
$category = $product['category'];
$price    = $product['price'];
$stock    = $product['stock'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price    = $_POST['price'] ?? '';
    $stock    = $_POST['stock'] ?? '';

    if (strlen($name) < 3) {
        $errors[] = "Nama produk minimal 3 karakter.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM products WHERE name = :name AND id != :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
        if ($stmt->fetch()) {
            $errors[] = "Nama produk sudah digunakan oleh produk lain.";
        }
    }

    if (empty($category)) $errors[] = "Kategori tidak boleh kosong.";
    if (!is_numeric($price) || $price <= 0) $errors[] = "Harga harus > 0.";
    if (!is_numeric($stock) || $stock < 0) $errors[] = "Stok harus >= 0.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE products SET name = :name, category = :category, price = :price, stock = :stock WHERE id = :id");
        $stmt->execute([
            'name'     => $name,
            'category' => $category,
            'price'    => $price,
            'stock'    => $stock,
            'id'       => $id
        ]);

        header("Location: index.php?msg=success_update");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <?php foreach ($errors as $err): ?>
                    <p><?= htmlspecialchars($err) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="edit.php?id=<?= $id ?>" method="POST">
            <label>Nama Produk:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required><br><br>

            <label>Kategori:</label><br>
            <input type="text" name="category" value="<?= htmlspecialchars($category) ?>" required><br><br>

            <label>Harga:</label><br>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($price) ?>" required><br><br>

            <label>Stok:</label><br>
            <input type="number" name="stock" value="<?= htmlspecialchars($stock) ?>" required><br><br>

            <button type="submit">Update Produk</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
</body>
</html>