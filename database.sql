CREATE DATABASE IF NOT EXISTS quiz_db;
USE quiz_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users (username, password) VALUES ('admin', 'admin123');
-- Tabel untuk daftar kuis
CREATE TABLE kuis (
    id_kuis INT AUTO_INCREMENT PRIMARY KEY,
    nama_kuis VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(255) NOT NULL
);

-- Tabel untuk soal-soal kuis
CREATE TABLE soal (
    id_soal INT AUTO_INCREMENT PRIMARY KEY,
    id_kuis INT,
    pertanyaan TEXT NOT NULL,
    pilihan_a VARCHAR(255),
    pilihan_b VARCHAR(255),
    pilihan_c VARCHAR(255),
    pilihan_d VARCHAR(255),
    jawaban_benar CHAR(1), -- 'a', 'b', 'c', atau 'd'
    FOREIGN KEY (id_kuis) REFERENCES kuis(id_kuis)
);
INSERT INTO kuis (nama_kuis, deskripsi) VALUES
('Kuis Bahasa Indonesia', 'Kuis ini menguji pengetahuan bahasa Indonesia'),
('Kuis Matematika Dasar', 'Kuis ini menguji pengetahuan matematika dasar');

INSERT INTO soal (id_kuis, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar) VALUES
(1, 'Apa sinonim kata "indah"?', 'Cantik', 'Buruk', 'Ruwet', 'Jelek', 'a'),
(1, 'Antonim dari "besar" adalah?', 'Kecil', 'Raksasa', 'Tinggi', 'Luas', 'a'),
(2, 'Hasil dari 5 + 3 adalah?', '6', '8', '9', '7', 'b'),
(2, 'Berapakah 10 × 2?', '12', '15', '20', '30', 'c');
