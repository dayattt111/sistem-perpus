<?php 
require "../../config/config.php"; 

// Cek apakah form telah disubmit
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : date('m');
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : date('Y');

// Query untuk laporan peminjaman bulanan
$query = "
    SELECT peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, member.jurusan, admin.nama_admin, peminjaman.tgl_peminjaman
    FROM peminjaman
    INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
    INNER JOIN member ON peminjaman.nisn = member.nisn
    INNER JOIN admin ON peminjaman.id_admin = admin.id
    WHERE MONTH(peminjaman.tgl_peminjaman) = ? AND YEAR(peminjaman.tgl_peminjaman) = ?
";

$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $bulan, $tahun); // "ss" berarti dua parameter string
$stmt->execute();
$result = $stmt->get_result();
$dataPeminjaman = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Laporan Peminjaman Buku Bulanan || Admin</title>
</head>
<body>
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
        <div class="container-fluid p-3">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logoNav.png" alt="logo" width="70px">
            </a>
            <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
        </div>
    </nav>
    
    <div class="p-4 mt-5">
        <div class="mt-5">
            <h2>Laporan Peminjaman Buku Bulanan</h2>
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <select name="bulan" class="form-select">
                            <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>Januari</option>
                            <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>Februari</option>
                            <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>Maret</option>
                            <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>April</option>
                            <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>Mei</option>
                            <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>Juni</option>
                            <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>Juli</option>
                            <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>Agustus</option>
                            <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>September</option>
                            <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>Oktober</option>
                            <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>November</option>
                            <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="tahun" class="form-select">
                            <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++): ?>
                                <option value="<?= $i; ?>" <?= $tahun == $i ? 'selected' : '' ?>><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th class="bg-primary text-light">ID Buku</th>
                            <th class="bg-primary text-light">Judul Buku</th>
                            <th class="bg-primary text-light">NISN</th>
                            <th class="bg-primary text-light">Nama Siswa</th>
                            <th class="bg-primary text-light">Jurusan</th>
                            <th class="bg-primary text-light">Nama Admin</th>
                            <th class="bg-primary text-light">Tanggal Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPeminjaman as $item) : ?>
                            <tr>
                                <td><?= $item["id_buku"]; ?></td>
                                <td><?= $item["judul"]; ?></td>
                                <td><?= $item["nisn"]; ?></td>
                                <td><?= $item["nama"]; ?></td>
                                <td><?= $item["jurusan"]; ?></td>
                                <td><?= $item["nama_admin"]; ?></td>
                                <td><?= $item["tgl_peminjaman"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <footer class="fixed-bottom shadow-lg bg-subtle p-3">
        <div class="container-fluid d-flex justify-content-between">
            <p class="mt-2">Created by <span class="text-primary">Mangandaralam Sakti</span> © 2023</p>
            <p class="mt-2">versi 1.0</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>