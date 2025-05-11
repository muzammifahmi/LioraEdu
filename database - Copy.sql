

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    role ENUM('admin', 'user') DEFAULT 'user'
);

INSERT INTO users (username, password, role) VALUES ('admin', 'admin123', 'admin');
-- Tabel untuk daftar kuis
CREATE TABLE kuis (
    id_kuis int(11) NOT NULL AUTO_INCREMENT,
    nama_kuis varchar(100) NOT NULL,
    deskripsi varchar(255) NOT NULL,
    id_user int(11) DEFAULT NULL,
    PRIMARY KEY (id_kuis),
    KEY id_user (id_user),
    CONSTRAINT kuis_ibfk_1 FOREIGN KEY (id_user) REFERENCES users (id`)
); 
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
('Bahasa Indonesia - Kuis Dasar', 'Kuis ini menguji pemahaman dasar Bahasa Indonesia.'),
('Bahasa Indonesia - Sinonim & Antonim', 'Uji kemampuan dalam mengenali sinonim dan antonim dalam Bahasa Indonesia.');


-- Soal untuk Kuis 1 (id_kuis = 1)
INSERT INTO soal (id_kuis, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar) VALUES
(13, 'Apa arti dari kata “merahasiakan”?', 'Menyebarkan', 'Menyimpan rahasia', 'Menghapus', 'Menuliskan', 'b'),
(13, 'Kalimat efektif adalah kalimat yang...', 'bertele-tele', 'mudah dipahami', 'panjang dan rumit', 'menggunakan kata baku', 'b'),
(13, 'Kata baku dari “praktek” adalah...', 'praktekan', 'praktik', 'praktek', 'praktikan', 'b'),
(13, 'Manakah kalimat yang menggunakan ejaan yang benar?', 'Saya tidak tahu menau.', 'Saya tidak tau-menau.', 'Saya tidak tahu-menahu.', 'Saya tidak tau-menahu.', 'c');

-- Soal untuk Kuis 2 (id_kuis = 2)
INSERT INTO soal (id_kuis, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar) VALUES
(14, 'Sinonim dari kata “indah” adalah...', 'jelek', 'menarik', 'buruk', 'rata', 'b'),
(14, 'Antonim dari kata “rajin” adalah...', 'giat', 'malas', 'cepat', 'teliti', 'b'),
(14, 'Sinonim dari kata “besar” adalah...', 'luas', 'tinggi', 'agung', 'kecil', 'c'),
(14, 'Antonim dari kata “dingin” adalah...', 'beku', 'hangat', 'dingin sekali', 'sejuk', 'b');

CREATE TABLE materi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    isi TEXT NOT NULL
);
INSERT INTO materi (judul, deskripsi, isi) VALUES
('Teks Narasi', 
'Teks yang menceritakan suatu peristiwa atau kejadian secara runtut.', 
'Teks narasi adalah jenis teks yang bertujuan untuk menceritakan suatu peristiwa atau pengalaman dengan urutan waktu yang jelas. Narasi biasanya memiliki unsur tokoh, latar, alur, dan konflik. Contoh teks narasi dapat ditemukan dalam cerita pendek, novel, dan biografi. Dalam pembelajaran Bahasa Indonesia, teks narasi penting untuk melatih kemampuan menyusun cerita dan memahami struktur cerita yang baik. Narasi dapat bersifat fiksi (rekaan) maupun nonfiksi (kisah nyata).'),
('Teks Deskripsi', 
'Teks yang menggambarkan suatu objek, tempat, atau peristiwa secara rinci.', 
'Teks deskripsi bertujuan untuk membuat pembaca seolah-olah melihat, mendengar, atau merasakan apa yang sedang dibahas. Teks ini biasanya digunakan untuk menggambarkan seseorang, tempat, benda, atau suasana secara detail. Dalam pembelajaran Bahasa Indonesia, siswa diajak untuk mengembangkan imajinasi dan kepekaan indera melalui penyusunan kalimat-kalimat deskriptif. Contoh teks deskripsi: "Pantai Parangtritis pada pagi hari tampak indah, dengan langit yang cerah dan ombak yang berkejaran ke tepian."'),
('Teks Eksposisi', 
'Teks yang bertujuan untuk memberikan informasi atau pengetahuan.', 
'Teks eksposisi digunakan untuk menjelaskan suatu hal secara logis dan sistematis, sering digunakan dalam artikel ilmiah, laporan, dan pidato. Struktur teks eksposisi meliputi: tesis (pendapat awal), argumentasi (alasan yang mendukung), dan penegasan ulang. Bahasa yang digunakan bersifat baku dan objektif. Contoh: "Kebersihan lingkungan sekolah penting untuk menciptakan suasana belajar yang nyaman. Oleh karena itu, siswa harus membuang sampah pada tempatnya dan menjaga kebersihan kelas."'),
('Teks Prosedur', 
'Teks yang menjelaskan langkah-langkah untuk melakukan sesuatu.', 
'Teks prosedur membantu pembaca melakukan suatu kegiatan dengan urutan yang tepat. Contohnya seperti resep makanan, petunjuk penggunaan alat, atau cara membuat kerajinan tangan. Teks ini terdiri dari tujuan, bahan atau alat, dan langkah-langkah. Dalam Bahasa Indonesia, teks prosedur melatih keterampilan menulis secara sistematis dan logis. Contoh: "Cara menyalakan komputer: 1. Pastikan kabel sudah terpasang. 2. Tekan tombol power pada CPU. 3. Tunggu hingga sistem operasi muncul."'),
('Teks Persuasi', 
'Teks yang bertujuan mempengaruhi pembaca untuk melakukan sesuatu.', 
'Teks persuasi banyak digunakan dalam iklan, kampanye, dan ajakan. Teks ini menyampaikan informasi dan membujuk pembaca agar melakukan tindakan tertentu. Struktur teks persuasi meliputi: pengenalan isu, argumen, fakta pendukung, dan ajakan. Ciri khasnya adalah penggunaan kata-kata ajakan seperti "ayo", "mari", dan "sebaiknya". Contoh: "Mari kita jaga hutan Indonesia! Dengan menjaga hutan, kita menjaga masa depan anak cucu kita dari bencana alam dan krisis iklim."');

CREATE TABLE hasil_kuis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_kuis INT,
    skor INT,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_kuis) REFERENCES kuis(id_kuis)
);

INSERT INTO hasil_kuis (id_user, id_kuis, skor) VALUES
(1, 11, 80),
(2, 11, 75);
