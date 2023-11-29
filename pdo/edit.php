<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Tugas 5 PHP PDO</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
          <span class="align-middle">Tugas 5 PHP PDO</span>
        </a>

		<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="datauser.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Data User</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
							<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
						</a>
					</li>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Update Data</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Data User</h5>
								</div>
								<div class="card-body">
									<?php
									require_once 'config.php';
									if (isset($_GET['id'])) {
										try {
											// sql statement untuk menampilkan data dari tabel is_siswa berdasarkan id
											$query = "SELECT * FROM users WHERE id=:id";
											// membuat prepared statements
											$stmt = $db->prepare($query);

											//mengikat parameter 
											$stmt->bindParam(':id', $_GET['id']);

											// eksekusi query
											$stmt->execute();

											// mengambil data siswa
											$data = $stmt->fetch(PDO::FETCH_ASSOC);

											// nilai untuk mengisi form
											$id = $data['id'];
											$name = $data['name'];
											$email = $data['email'];

											// tutup koneksi database
											$db = null;
										} catch (PDOException $e) {
											// tampilkan pesan kesalahan
											echo "ada kesalahan pada query : " . $e->getMessage();
										}
									}
									?>
									<form method="POST" action="proses-edit.php">
										<input type="hidden" name="id" value="<?php echo $id; ?>">
										<div class="mb-3">
											<label class="form-label">Nama</label>
											<input class="form-control form-control-lg" type="text" name="name" value="<?php echo $name; ?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $email; ?>" required />
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-success">Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="../js/app.js"></script>

</body>

</html>