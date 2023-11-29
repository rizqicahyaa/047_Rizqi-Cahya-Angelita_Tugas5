<?php
require_once('config.php');

// Ambil data pengguna dari database (contoh sederhana, sesuaikan dengan struktur tabel Anda)
$query = "SELECT id, email, name FROM users";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

// Proses pencarian
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT email, name FROM users WHERE email LIKE '%$search%'";
    $result = $conn->query($query);

    if (!$result) {
        die("Error searching data: " . $conn->error);
    }
}

// Hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $idToDelete);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke halaman datauser.php setelah menghapus
    header('Location: datauser.php');
    exit();
}
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

	<title>Tugas 5 PHP MYSQLI</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
          <span class="align-middle">Tugas 5 PHP MYSQLI</span>
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
								<form class="d-flex" method="GET">
									<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
									<button class="btn btn-outline-primary" type="submit">Search</button>
								</form>
								</div>
								<div class="card-body">
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th class="d-none d-xl-table-cell">Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>". $row['email'] ."</td>";
                                                echo "<td class='d-none d-md-table-cell'>
                                                        <a href='edit.php?id=" . $row['id'] . "'><button class='btn btn-primary'>Edit</button></a>
                                                        <a href='datauser.php?action=delete&id=" . $row['id'] . "'><button class='btn btn-danger'>Hapus</button></a>
                                                      </td>";
                                                echo "</tr>";
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