<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // sql statement untuk update data di tabel users berdasarkan id
        $query = "UPDATE users SET name=:name, email=:email WHERE id=:id";
        // membuat prepared statements
        $stmt = $db->prepare($query);

        //mengikat parameter 
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':email', $_POST['email']);

        // eksekusi query
        $stmt->execute();

        // tutup koneksi database
        $db = null;

        // Redirect to datauser.php after successful update
        header('Location: datauser.php');
        exit();
    } catch (PDOException $e) {
        // tampilkan pesan kesalahan
        echo "ada kesalahan pada query : " . $e->getMessage();
    }
}
?>
