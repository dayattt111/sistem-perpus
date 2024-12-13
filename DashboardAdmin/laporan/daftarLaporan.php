<?php
require "../../config/config.php"; 

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Query untuk mengambil laporan peminjaman
$sql = "SELECT b.judul, COUNT(p.id) as total_peminjaman 
        FROM peminjaman p 
        JOIN buku b ON p.id_buku = b.id 
        WHERE MONTH(p.tanggal_pinjam) = :bulan AND YEAR(p.tanggal_pinjam) = :tahun 
        GROUP BY p.id_buku";

$stmt = $pdo->prepare($sql);
$stmt->execute(['bulan' => $bulan, 'tahun' => $tahun]);
$laporan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Buku Bulanan</title>
</head>
<body>
    <h1>Laporan Peminjaman Buku Bulanan</h1>
    
    <form method="GET" action="">
        <label for="bulan">Bulan:</label>
        <select name="bulan" id="bulan">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($i == $bulan) ? 'selected' : ''; ?>>
                    <?php echo date('F', mktime(0, 0, 0, $i, 1)); ?>
                </option>
            <?php endfor; ?>
        </select>
        
        <label for="tahun">Tahun:</label>
        <input type="number" name="tahun" id="tahun" value="<?php echo $tahun; ?>" required>
        
        <input type="submit" value="Tampilkan Laporan">
    </form>

    <table border="1">
        <tr>
            <th>Judul Buku</th>
            <th>Total Peminjaman</th>
        </tr>
        <?php if ($laporan): ?>
            <?php foreach ($laporan as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['judul']); ?></td>
                <td><?php echo htmlspecialchars($row['total_peminjaman']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Tidak ada data peminjaman untuk bulan dan tahun ini.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>