<?php
include 'connection.php';
session_start();

$action = $_GET['action'];

if(!isset($action)){
    header('Location: listing_ads.php');
}
else if ($action == 'deleterekomendasi'){
    $sqlrekomendasi = 'DELETE FROM tabel_rekomendasi
    WHERE nomor_rekomendasi = :nomor_rekomendasi';
    
    $stmt = $pdo->prepare($sqlrekomendasi);
    $stmt->execute(['nomor_rekomendasi' => $_GET['nomor_rekomendasi']]);
    header('Location: kelola_standar_perkembangan.php?status=deletesuccess');
}