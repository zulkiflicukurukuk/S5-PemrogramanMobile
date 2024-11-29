<?php
  require_once('provider.php');
  $data = fetch();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARPEDIEM - Buy Your Favorite CDs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Tugas2.css"> <!-- Update path if necessary -->
</head>
<body>
    <div class="container">
        <header>
            <div class="logo-nav">
                <div class="logo">CARPEDIEM</div>
                <nav class="nav-links">
                    <a href="#get-started">Home</a>
                    <a href="#movies">Movies</a>
                    <a href="#cart-section">Cart</a>
                </nav>
            </div>
            <input type="text" class="search-bar" placeholder="Search..." id="searchBar" onkeyup="filterCDs()">
        </header>

        <section id="get-started">
            <h2>The Best CD Collection</h2>
            <p>Discover a wide range of CDs, from movies to music albums. Start building your collection today!</p>
            <button class="get-started-btn" onclick="location.href='#movies'">Get Started Now</button>
        </section>

        <section id="movies">
            <h3 class="section-title">Available CDs</h3>
            <div class="cd-grid" id="cdGrid">
                <?php
                // Loop untuk menampilkan data produk
                 foreach ($data['data'] as $row) {
                ?>
                <div class="cd-card">
                    <img src="<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <div class="cd-info">
                        <h4 class="cd-title"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                        <div class="price">$<?php echo number_format($row['price'], 2); ?></div>
                        <!-- Tombol untuk menambahkan ke keranjang dengan data-id sebagai product_id -->
                        <button class="add-to-cart" data-id="<?php echo $row['product_id']; ?>" data-title="<?php echo htmlspecialchars($row['product_name']); ?>" data-price="<?php echo $row['price']; ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>
        

        <footer>
            <div class="footer-bottom">
                <p>&copy; 2024 CARPEDIEM | All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        var productButtons = document.getElementsByClassName("add-to-cart");
        for (var i = 0; i < productButtons.length; i++) {
            productButtons[i].addEventListener("click", function (event) {
                var target = event.target;
                var id = target.getAttribute("data-id");
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        target.innerHTML = data.in_cart;
                        // Update badge or cart count if available
                        if (document.getElementById("badge")) {
                            document.getElementById("badge").innerHTML = data.num_cart;
                        }
                    }
                };
                xhr.open("GET", "connection.php?id=" + id, true);
                xhr.send();
            });
        }
    </script>
</body>
</html>
        