<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data - Data Telkom</title>
    <link rel="stylesheet" href="style_index1.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Bidang Kesehatan</h1>
        </header>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Bidang_Umum.php">Bidang Umum</a></li>
                <li><a href="Bidang_Kesehatan.php">Bidang Kesehatan</a></li>
                <li><a href="Bidang_Investasi.php">Bidang Investasi</a></li>
                <li><a href="Bidang_Keuangan.php">Bidang Keuangan</a></li>
            </ul>
        </nav>

        <main>
            <center><h1>Pencarian Data</h1></center>
            <form method="GET" action="Bidang_Kesehatan.php" style="text-align: center;">
                <label>Kata Pencarian: </label>
                <input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>" />
                <button type="submit">Cari</button>
            </form>
            <br>

            <table border="0" align="center" width="1900px" height="500px">
                <thead>
                    <tr bgcolor="lightblue">
                        <th>ID</th>
                        <th>Nomor Surat</th>
                        <th>Judul</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include koneksi database
                    include 'Koneksi.php';

                    // Periksa apakah ada kata kunci pencarian
                    if(isset($_GET['kata_cari'])) {
                        $kata_cari = $_GET['kata_cari'];
                        $query = "SELECT * FROM bidang_kesehatan WHERE `Nomor Surat` LIKE '%$kata_cari%' OR `Judul` LIKE '%$kata_cari%' ORDER BY `Nomor Surat` ASC LIMIT 10";
                    } else {
                        $query = "SELECT * FROM bidang_kesehatan ORDER BY `id` ASC";
                    }

                    $result = mysqli_query($koneksi, $query);

                    // Cek jika query gagal
                    if(!$result) {
                        die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                    }

                    // Lakukan perulangan untuk menampilkan data
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['Nomor Surat']; ?></td>
                            <td><?php echo $row['Judul']; ?></td>
                        </tr>
                        <?php
                    }

                    ?>
                </tbody>
            </table>
        </main>
    </div>

</body>
</html>
