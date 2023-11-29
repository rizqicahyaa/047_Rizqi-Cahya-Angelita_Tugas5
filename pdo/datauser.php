<?php
include 'config.php';
// Handling search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$condition = $search ? "WHERE name LIKE '%$search%' OR email LIKE '%$search%'" : '';

?>
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

					<h1 class="h3 mb-3">Menampilkan Data</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<form class="d-flex" method="get" action="">
									<input class="form-control me-2" type="text" id="search" name="search" placeholder="Pencarian Data" value="<?php echo $search; ?>">
									<button class="btn btn-outline-primary" type="submit">Cari</button>
								</form>
								</div>
								<div class="card-body">
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Email</th>
												<th class="d-none d-xl-table-cell">Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$no = 1;

										// sql statement untuk menampilkan semua data dari tabel users
										$query = "SELECT * FROM users $condition ORDER BY id DESC";
										// membuat prepared statements
										$stmt = $db->prepare($query);

										// eksekusi query
										$stmt->execute();

										// tampilkan data
										while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
											echo "  <tr>
													<td>$no</td>
													<td>$data[name]</td>
													<td>$data[email]</td>

													<td>
														<div class=''>
														<a data-toggle='tooltip' data-placement='top' title='Edit' class='btn btn-success' href='edit.php?page=edit&id=$data[id]'>
															Edit
														</a>";
										?>
										<a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger" href="hapus.php?id=<?php echo $data['id'];?>" 
											onclick="return confirm('Anda yakin ingin menghapus siswa <?php echo $data['name']; ?>?');"> Hapus
										</a>
										 <?php
												
												$no++;
											}
											?>
										</tbody>
									</table>
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