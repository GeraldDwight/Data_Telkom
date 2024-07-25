// Menentukan jumlah data per halaman
$dataPerPage = 10;

// Menentukan halaman yang sedang aktif
if(isset($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
} else {
    $currentPage = 1;
}

// Menghitung offset data
$start = ($currentPage - 1) * $dataPerPage;

// Menjalankan query dengan LIMIT dan OFFSET
$query = "SELECT * FROM bidang_kesehatan WHERE `Nomor Surat` LIKE '%$kata_cari%' ORDER BY `Nomor Surat` ASC LIMIT $dataPerPage OFFSET $start";
$result = mysqli_query($koneksi, $query);

// Menghitung jumlah halaman total
$totalData = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bidang_kesehatan WHERE `Nomor Surat` LIKE '%$kata_cari%'"));
$totalPages = ceil($totalData / $dataPerPage);

// Menampilkan data dan pagination
while ($row = mysqli_fetch_assoc($result)) {
    // Menampilkan data seperti sebelumnya
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['Nomor Surat']; ?></td>
        <td><?php echo $row['Judul']; ?></td>
    </tr>
    <?php
}

// Menampilkan link pagination
if($totalPages > 1) {
    echo "<br><center>";
    for($i = 1; $i <= $totalPages; $i++) {
        if($i == $currentPage) {
            echo "<b>$i</b> ";
        } else {
            echo "<a href='index.php?page=$i&kata_cari=$kata_cari'>$i</a> ";
        }
    }
    echo "</center>";
}
