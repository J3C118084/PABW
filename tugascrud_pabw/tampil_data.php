<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>CRUD</title>
</head>

<body>
    <div class="container" style="margin-top:20px">
        <div class="py-4 d-flex justify-content-end align-items-center">
            <h2 class="mr-auto">Data mahasiswa</h2>
            <a href="tambah_data.php" class="btn btn-dark">
                Tambah Data
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Olahraga Favorit</th>
                    <th>File Upload</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $sql = mysqli_query($koneksi, "SELECT * FROM crud_mahasiswa ORDER BY id ASC") or die(mysqli_error($koneksi));
                if (mysqli_num_rows($sql) > 0) {
                    $id = 1;
                    while ($data = mysqli_fetch_assoc($sql)) {
                        echo '
						<tr>
							<td>' . $id . '</td>
							<td>' . $data['nim'] . '</td>
							<td>' . $data['nama'] . '</td>
							<td>' . $data['jkelamin'] . '</td>
                            <td>' . $data['agama'] . '</td>
                            <td>' . $data['olahraga'] . '</td>
                            <td><center><img src=' . "file/" . $data['foto'] . ' width="70px"></td>
							<td>
								<a href="edit_data.php?id=' . $data['id'] . '" class="badge badge-info">Edit</a>
								<a href="delete_data.php?id=' . $data['id'] . '" class="badge badge-dark" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
                        $id++;
                    }
                } else {
                    echo '
					<tr>
						<td colspan="8">Tidak ada data.</td>
					</tr>
					';
                }
                ?>
            <tbody>
        </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>