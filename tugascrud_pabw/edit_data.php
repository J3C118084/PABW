<?php include('koneksi.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>CRUD PHP</title>
</head>

<body>
	<div class="container" style="margin-top:20px">
		<h2>Edit Mahasiswa</h2>

		<hr>

		<?php

		if (isset($_GET['id'])) {

			$id = $_GET['id'];


			$select = mysqli_query($koneksi, "SELECT * FROM crud_mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));


			if (mysqli_num_rows($select) == 0) {
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();

			} else {

				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php

		if (isset($_POST['submit'])) {
			$nama			= $_POST['nama'];
			$jenis_kelamin	= $_POST['jkelamin'];
			$agama			= $_POST['agama'];
			$olahraga		= implode(",",$_POST['olahraga']);

			$sql = mysqli_query($koneksi, "UPDATE crud_mahasiswa SET nama='$nama', jkelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga' WHERE id='$id'") or die(mysqli_error($koneksi));

			if ($sql) {
				echo '<script>alert("Berhasil menyimpan data."); document.location="edit_data.php?id=' . $id . '";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="edit_data.php?id=<?php echo $id; ?>" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" value="<?php echo $data['nim']; ?>" readonly required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jkelamin" value="Laki-laki" <?php if ($data['jkelamin'] == 'Laki-laki') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jkelamin" value="Perempuan" <?php if ($data['jkelamin'] == 'Perempuan') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Perempuan</label>
					</div>
				</div>
			</div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                <?php $agama = $data["agama"];?>
                <select class="form-control" id="agama" name="agama">
                <option value="Islam" <?php echo ($agama == 'Islam') ? "selected": ""?>>Islam</option>
                <option value="Protestan" <?php echo ($agama == 'Protestan') ? "selected": ""?>>Protestan</option>
                <option value="Katolik" <?php echo ($agama == 'Katolik') ? "selected": ""?>>Katolik</option>
                <option value="Hindu" <?php echo ($agama == 'Hindu') ? "selected": ""?>>Hindu</option>
                <option value="Buddha" <?php echo ($agama == 'Buddha') ? "selected": ""?>>Buddha</option>
                <option value="Konghucu" <?php echo ($agama == 'Konghucu') ? "selected": ""?>>Konghucu</option>
                </select>
                </div>
            </div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Olahraga</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="olahraga[]" value="Badminton" <?php if ($data['olahraga'] == 'Badminton') {
																												echo 'checked';
																											} ?>>
						<label class="form-check-label">
							Badminton
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="olahraga[]" value="Lari" <?php if ($data['olahraga'] == 'Futsal') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Lari
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="olahraga[]" value="Sepeda" <?php if ($data['olahraga'] == 'Sepeda') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Sepeda
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="olahraga[]" value="Basket" <?php if ($data['olahraga'] == 'Basket') {
																											echo 'checked';
																										} ?>>
						<label class="form-check-label">
							Basket
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">File Upload</label>
				<div class="col-sm-10">
					<img src="<?php echo "file/" . $data['foto']; ?>" width="70px" disabled>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="tampil_data.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>