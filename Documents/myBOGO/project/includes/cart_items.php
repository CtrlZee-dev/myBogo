<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
?>
        <div class="card border shadow-none">
            <div class="card-body">
                <div class="avatar">
                    <img src="../project_Control_Panel/uploads/<?php echo $item['image']; ?>" alt="Product Image">
                </div>
                <div>
                    <h5 class="text-truncate font-size-18"><a href="#" class="text-dark"><?php echo $item['name']; ?></a></h5>
                    <p class="text-muted mb-2">Price: R<?php echo $item['price']; ?></p>
                    <p class="text-muted mb-2">Total: R<?php echo $item['price'] * $item['quantity']; ?></p>
                </div>
                <div class="actions">
                    <form action="" method="post">
                        <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>">
                        <select class="form-select form-select-sm w-xl" name="update_quantity" onchange="this.form.submit()">
                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                                <option value="<?php echo $i; ?>" <?php echo ($i == $item['quantity']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="delete-btn" onclick="return confirm('Remove item from cart?')"><i class="fas fa-trash"></i> remove</a>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<p>Your cart is empty.</p>";
}
?>