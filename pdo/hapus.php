<?php
// Panggil koneksi database
require_once "config.php";

$id = $_GET['id'];

if (isset($id)) {
	try {
		// sql statement untuk menghapus data pada tabel users
        $query = "DELETE FROM users WHERE id=:id";
        // membuat prepared statements
		$stmt = $db->prepare($query);

		//mengikat parameter 
		$stmt->bindParam(':id', $id);

		// eksekusi query
		$stmt->execute();

        // jika berhasil tampilkan pesan berhasil delete data
		header('location: datauser.php');

		// tutup koneksi database
        $db = null;
	} catch (PDOException $e) {
		// tampilkan pesan kesalahan
        echo "ada kesalahan : ".$e->getMessage();
	}
}					
?>