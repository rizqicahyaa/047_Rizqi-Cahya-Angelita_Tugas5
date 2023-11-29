<?php
require_once('config.php');

// Periksa apakah ID pengguna telah diberikan
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $stmt = $conn->prepare("SELECT id, email, name FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $email, $name);
    $stmt->fetch();
    $stmt->close();
} else {
    // Redirect kembali ke halaman datauser.php jika ID pengguna tidak tersedia
    header('Location: datauser.php');
    exit();
}

// Update data setelah pengguna mengirimkan formulir edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari formulir
    $newEmail = $_POST['email'];
    $newName = $_POST['name'];

    // Query untuk mengupdate data pengguna
    $stmt = $conn->prepare("UPDATE users SET email = ?, name = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newEmail, $newName, $userId);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke halaman datauser.php setelah mengupdate
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

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

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
									<form method="POST">
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input class="form-control form-control-lg" type="name" name="name" value="<?php echo htmlspecialchars($name); ?>"/>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
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
