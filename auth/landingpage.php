<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>--LioraEdu--</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#4F46E5",
            secondary: "#10B981"
          },
          borderRadius: {
            none: "0px",
            sm: "4px",
            DEFAULT: "8px",
            md: "12px",
            lg: "16px",
            xl: "20px",
            "2xl": "24px",
            "3xl": "32px",
            full: "9999px",
            button: "8px",
          },
        },
      },
    };
  </script>
  <style>
    :where([class^="ri-"])::before {
      content: "\f3c2";
    }

    body {
      font-family: 'Inter', sans-serif;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .hero-section {
      background-image: linear-gradient(to right, rgba(79, 70, 229, 0.9) 0%, rgba(79, 70, 229, 0.7) 50%, rgba(79, 70, 229, 0) 100%), url('https://readdy.ai/api/search-image?query=modern%2520educational%2520environment%2520with%2520students%2520learning%2520on%2520digital%2520devices%252C%2520bright%2520and%2520airy%2520classroom%2520with%2520natural%2520light%252C%2520showing%2520diverse%2520group%2520of%2520students%2520engaged%2520in%2520collaborative%2520learning%252C%2520soft%2520gradient%2520background%2520on%2520the%2520left%2520side%2520fading%2520to%2520clear%2520on%2520right&width=1200&height=600&seq=1&orientation=landscape');
      background-size: cover;
      background-position: center;
    }

    .cta-section {
      background: linear-gradient(135deg, #4F46E5 0%, #10B981 100%);
    }
  </style>
</head>

<body class="bg-gray-50">
  <!-- Header Section -->
  <header class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between h-16 md:h-20">
        <div class="flex items-center">
          <a href="#" class="text-2xl font-['Pacifico'] text-primary">LioraEdu</a>
        </div>
        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
          <a href="#" class="text-gray-800 hover:text-primary font-medium">Beranda</a>
          <a href="#" class="text-gray-800 hover:text-primary font-medium">Tentang Kami</a>
        </div>
        <div class="hidden md:flex items-center space-x-4">
          <a
            href="login.php"
            class="px-4 py-2 text-primary border border-primary hover:bg-primary hover:text-white transition duration-300 !rounded-button whitespace-nowrap">Masuk</a>
          <a
            href="register.php"
            class="px-4 py-2 bg-primary text-white hover:bg-primary/90 transition duration-300 !rounded-button whitespace-nowrap">Daftar</a>
        </div>
        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
          <button
            id="mobile-menu-button"
            class="w-10 h-10 flex items-center justify-center text-gray-700">
            <i class="ri-menu-line ri-lg"></i>
          </button>
        </div>
      </nav>
      <!-- Mobile Menu -->
      <div id="mobile-menu" class="md:hidden hidden pb-4">
        <div class="flex flex-col space-y-3">
          <a
            href="#"
            class="text-gray-800 hover:text-primary font-medium py-2">Beranda</a>
          <a
            href="#"
            class="text-gray-800 hover:text-primary font-medium py-2">Tentang Kami</a>
          <div class="flex space-x-4 pt-2">
            <a
              href="#"
              class="px-4 py-2 text-primary border border-primary hover:bg-primary hover:text-white transition duration-300 !rounded-button whitespace-nowrap">Masuk</a>
            <a
              href="#"
              class="px-4 py-2 bg-primary text-white hover:bg-primary/90 transition duration-300 !rounded-button whitespace-nowrap">Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Hero Section -->
  <section class="hero-section min-h-[600px] pt-24 flex items-center">
    <div class="container mx-auto px-4 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div class="text-white">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
            Belajar Lebih Mudah di LioraEdu
          </h1>
          <p class="text-lg md:text-xl mb-8">
            Platform pembelajaran online yang membantu kamu meraih mimpi
          </p>
          <a
            href="#"
            class="inline-block px-6 py-3 bg-white text-primary font-semibold hover:bg-gray-100 transition duration-300 !rounded-button whitespace-nowrap">Mulai Belajar</a>
        </div>
        <div class="hidden lg:block">
        </div>
      </div>
    </div>
  </section>
  <!-- Features Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          LioraEdu hadir dengan berbagai fitur yang memudahkan proses
          pembelajaran Anda
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div
          class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <div
            class="w-16 h-16 flex items-center justify-center bg-primary/10 rounded-full mb-6 mx-auto">
            <i class="ri-book-open-line ri-2x text-primary"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 text-center">
            Materi Berkualitas
          </h3>
          <p class="text-gray-600 text-center">
            Materi pembelajaran disusun oleh para ahli di bidangnya dan selalu
            diperbarui mengikuti perkembangan terkini.
          </p>
        </div>


        <!-- Feature 3 -->
        <div
          class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <div
            class="w-16 h-16 flex items-center justify-center bg-primary/10 rounded-full mb-6 mx-auto">
            <i class="ri-time-line ri-2x text-primary"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 text-center">
            Belajar Fleksibel
          </h3>
          <p class="text-gray-600 text-center">
            Akses materi kapan saja dan di mana saja sesuai dengan jadwal dan
            kecepatan belajar Anda.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Courses Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilihan Materi</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Temukan berbagai materi menarik yang sesuai dengan minat dan
          kebutuhan Anda
        </p>
      </div>

      <div class="relative">
        <div
          id="courses-carousel"
          class="flex overflow-x-auto pb-8 -mx-4 px-4 space-x-6 scrollbar-hide">
          <!-- Materi 1 -->
          <?php
          include_once '../koneksi.php';
          if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
          }
          $sql = "SELECT id, judul, deskripsi FROM materi";
          $result = $koneksi->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <div class="flex-none w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                <div
                  class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                  <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                      <?php echo htmlspecialchars($row['judul']); ?>
                    </h3>
                    <p class="text-gray-600 text-sm mb-3">
                      <?php echo htmlspecialchars($row['deskripsi']); ?>
                    </p>
                    <a href="?page=materi&item=tampil_materi&id=<?php echo $row['id']; ?>" class="text-sm text-primary hover:underline">Lihat Detail</a>
                  </div>
                </div>  
              </div>
          <?php
            }
          } else {
            echo "<p class='text-center text-gray-600'>Belum ada materi tersedia.</p>";
          }
          $koneksi->close();
          ?>

          <!-- Materi lainnya -->
          <!-- ... -->
        </div>

        <!-- Navigation Buttons -->
        <button
          id="prev-course"
          class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full shadow-md p-2 hover:bg-gray-100 focus:outline-none">
          <i class="ri-arrow-left-s-line ri-lg text-gray-700"></i>
        </button>
        <button
          id="next-course"
          class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full shadow-md p-2 hover:bg-gray-100 focus:outline-none">
          <i class="ri-arrow-right-s-line ri-lg text-gray-700"></i>
        </button>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section py-16 text-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">
        Siap Untuk Mulai Belajar?
      </h2>
      <p class="text-lg mb-8 max-w-2xl mx-auto">
        Bergabunglah dengan ribuan siswa lainnya dan mulai perjalanan
        pembelajaran Anda bersama LioraEdu
      </p>
      <a
        href="#"
        class="inline-block px-8 py-4 bg-white text-primary font-semibold hover:bg-gray-100 transition duration-300 !rounded-button whitespace-nowrap text-lg">Daftar Sekarang</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <!-- Column 1 -->
        <div>
          <h3 class="text-xl font-['Pacifico'] text-white mb-6">
            LioraEdu
          </h3>
          <p class="text-gray-400 mb-6">
            Platform pembelajaran online terbaik di Indonesia yang membantu
            Anda mengembangkan keterampilan dan meraih karir impian.
          </p>
          <div class="flex space-x-4">
            <a
              href="#"
              class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition duration-300">
              <i class="ri-facebook-fill text-white"></i>
            </a>
            <a
              href="#"
              class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition duration-300">
              <i class="ri-twitter-x-fill text-white"></i>
            </a>
            <a
              href="#"
              class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition duration-300">
              <i class="ri-instagram-fill text-white"></i>
            </a>
            <a
              href="#"
              class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition duration-300">
              <i class="ri-linkedin-fill text-white"></i>
            </a>
          </div>
        </div>

        <!-- Column 4 -->
        <div>
          <h3 class="text-lg font-semibold mb-6">Kontak</h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <div class="w-5 h-5 flex items-center justify-center mt-1 mr-3">
                <i class="ri-map-pin-line text-primary"></i>
              </div>
              <span class="text-gray-400">Jl. Raya Randuagung 2, Kabupaten Malang, Jawa Timur</span>
            </li>
            <li class="flex items-center">
              <div class="w-5 h-5 flex items-center justify-center mr-3">
                <i class="ri-phone-line text-primary"></i>
              </div>
              <span class="text-gray-400">+6285895703935</span>
            </li>
            <li class="flex items-center">
              <div class="w-5 h-5 flex items-center justify-center mr-3">
                <i class="ri-mail-line text-primary"></i>
              </div>
              <span class="text-gray-400">info@LioraEdu.id</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-800 pt-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-500 text-sm mb-4 md:mb-0">
            &copy; 2025 LioraEdu. Hak Cipta Dilindungi.
          </p>
          <div class="flex space-x-6">
            <a
              href="#"
              class="text-gray-500 text-sm hover:text-white transition duration-300">Syarat & Ketentuan</a>
            <a
              href="#"
              class="text-gray-500 text-sm hover:text-white transition duration-300">Kebijakan Privasi</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Mobile Menu Toggle
      const mobileMenuButton = document.getElementById("mobile-menu-button");
      const mobileMenu = document.getElementById("mobile-menu");

      mobileMenuButton.addEventListener("click", function() {
        mobileMenu.classList.toggle("hidden");
        if (mobileMenu.classList.contains("hidden")) {
          mobileMenuButton.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
        } else {
          mobileMenuButton.innerHTML = '<i class="ri-close-line ri-lg"></i>';
        }
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      // Courses Carousel Navigation
      const coursesCarousel = document.getElementById("courses-carousel");
      const prevCourseBtn = document.getElementById("prev-course");
      const nextCourseBtn = document.getElementById("next-course");

      let scrollAmount = 0;
      const cardWidth = coursesCarousel.querySelector("div").offsetWidth + 24; // card width + gap

      prevCourseBtn.addEventListener("click", function() {
        scrollAmount = Math.max(scrollAmount - cardWidth, 0);
        coursesCarousel.scrollTo({
          left: scrollAmount,
          behavior: "smooth",
        });
      });

      nextCourseBtn.addEventListener("click", function() {
        scrollAmount = Math.min(
          scrollAmount + cardWidth,
          coursesCarousel.scrollWidth - coursesCarousel.clientWidth,
        );
        coursesCarousel.scrollTo({
          left: scrollAmount,
          behavior: "smooth",
        });
      });
    });
  </script>
</body>

</html>