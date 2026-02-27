<?php
include("includes/header.php");
require_once "includes/db.php";
?>

<div id="content">
    <h1>Our Products</h1>

    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0):
            while($product = mysqli_fetch_assoc($result)):
        ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="product-price">Rs. <?php echo number_format($product['price'], 2); ?></p>
                    <a href="cart.php?add=<?php echo $product['id']; ?>" class="add-to-cart-btn">Add to Cart</a>
                </div>
        <?php
            endwhile;
        else:
        ?>
            <p>No products found.</p>
        <?php endif; ?>

        <?php mysqli_free_result($result); ?>
    </div>
</div>

<?php
include("includes/footer.php");  
?>
