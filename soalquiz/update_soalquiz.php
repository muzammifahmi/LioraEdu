<?php
include 'koneksi.php';
if (isset($_POST['question_id']) && isset($_POST['question_text'])) {
    $question_id = $_POST['question_id'];
    $question_text = $_POST['question_text'];

    // Ambil jawaban yang benar
    $correct_answer = $_POST['correct_answer'];

    // Ambil pilihan jawaban
    $answers = $_POST['answers'];

    // Update soal
    $update_soal = "UPDATE soal SET pertanyaan = ? WHERE id_soal = ?";
    $stmt_update_soal = $koneksi->prepare($update_soal);
    $stmt_update_soal->bind_param("si", $question_text, $question_id);
    $stmt_update_soal->execute();

    // Update pilihan jawaban
    $update_pilihan = "UPDATE soal SET 
        pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, jawaban_benar = ?
        WHERE id_soal = ?";
    $stmt_update_pilihan = $koneksi->prepare($update_pilihan);
    $stmt_update_pilihan->bind_param("sssssi", 
        $answers['a'], $answers['b'], $answers['c'], $answers['d'], $correct_answer, $question_id);
    $stmt_update_pilihan->execute();

    // Redirect atau berikan feedback sukses
    header("Location: index.php?page=soalquiz&item=tampil_soalquiz");
}
?>
