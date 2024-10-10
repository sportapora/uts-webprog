<?php
include 'assets/header.php';
include '../connection/connection.php';

// $id = isset(($_GET['id']) ? (int)$_GET['id'] : 0);

if ($id > 0) {
    $sql = 'SELECT CONCAT(nama_depan, " ", nama_belakang) AS full_name, email, no_tlp, alamat FROM user WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Pengguna Tidak Ditemukan";
        exit();
    }

} else {
    echo "ID Pengguna Tidak Ditemukan";
    exit();
}

?>

<div class="container">
    <h1>Detail Pengguna</h1>
    <p>Nama: <?php echo htmlspecialchars($user['nama'])?></p>
    <p></p>
</div>

<?php
include 'assets/footer.php';
?>