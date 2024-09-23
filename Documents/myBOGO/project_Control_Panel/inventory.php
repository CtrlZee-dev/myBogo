<?php
include('./includes/header.php');
$mysqli = new mysqli("localhost", "root", "Fuck.you67", "login_db");


// Check if the form is submitted for deleting product
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $productId = $_POST['delete_id'];

    // Prepare a delete statement
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $mysqli->error;
    } else {
        // Bind the product ID parameter
        $stmt->bind_param("i", $productId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Fetch and display products
$result = $mysqli->query("SELECT * FROM products");

?>



<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>


        <main id="inventory" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Inventory Section -->
            <div class="row mb-4">
                <div class="col">
                    <h2 class="orderh2">Inventory</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search items">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>
                    <button class="btn btn-outline-success mb-3" onclick="document.getElementById('addProductForm').style.display='block'">Add New Item</button>


                    <div id="addProductForm" style="display:none;">
                        <form method="post" enctype="multipart/form-data" action="addProduct.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="addName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="addCategory" name="category" required>
                                    <option value="Makeup">Makeup</option>
                                    <option value="Accessories">Accessories</option>
                                    <option value="Treatments and Serums">Treatments and Serums</option>
                                    <option value="Moisture and Scrubs">Moisture and Scrubs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="addQuantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="addPrice" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="addDescription" name="description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="addImage" name="image" style="width: 200px  " required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 150px;">Add Product</button>
                        </form>
                    </div>

                </div>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $mysqli->query("SELECT * FROM products");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['id'] . "</th>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>$" . $row['price'] . "</td>";
                            echo "<td>";
                            echo
                            "<button type='button' class='btn btn-primary' onclick='editProduct(" . $row['id'] . ", \"" . $row['name'] . "\", \"" . $row['category'] . "\", " . $row['quantity'] . ", " . $row['price'] . ", \"" . $row['description'] . "\")'>Edit</button>";

                            echo "    <form method='post' action='inventory.php'>
                                            <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                            <button type='submit' class='btn btn-ml btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</button>
                                        </form>";
                            echo "</td>";


                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>

                <div id="editProductForm" style="display:none;">
                    <form id="editProduct" method="post" enctype="multipart/form-data" action="editProduct.php">
                        <h2 class="orderh2 cust2">Update Product</h2>

                        <input type="hidden" id="editProductId" name="editProductId"> <!-- Hidden field for product ID -->
                        <div class="mb-3">
                            <label for="editName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editName" name="editName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategory" class="form-label">Category</label>
                            <select class="form-control" id="editCategory" name="editCategory" required>
                                <option value="Makeup">Makeup</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Treatments and Serums">Treatments and Serums</option>
                                <option value="Moisture and Scrubs">Moisture and Scrubs</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editQuantity" name="editQuantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="editPrice" name="editPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="editDescription" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editImage" name="editImage" style="width: 200px;">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <button type="button" class="btn btn-secondary" onclick="closeForm('editProductForm')">Close</button>
                    </form>
                </div>

            </div>
    </div>




    </main>


</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open('POST', 'deleteProduct.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Callback function when the request completes
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    // Success callback, handle response
                    console.log(xhr.responseText); // Log response to console (optional)

                    // Optionally, reload or update the product listing after deletion
                    // For example, reload the page:
                    window.location.reload();
                } else {
                    // Error callback, handle error
                    console.error('Error deleting product:', xhr.statusText);
                    alert('Error deleting product. Please try again.');
                }
            };

            // Error handling for network errors
            xhr.onerror = function() {
                console.error('Network error deleting product.');
                alert('Network error deleting product. Please try again.');
            };

            // Send the request with the product ID as data
            var formData = 'delete_id=' + encodeURIComponent(id);
            xhr.send(formData);
        }
    }


    function editProduct(id, name, category, quantity, price, description) {
        document.getElementById("addProductForm").style.display = "none";
        document.getElementById("editProductForm").style.display = "block";
        document.getElementById("editProductId").value = id;
        document.getElementById("editName").value = name;
        document.getElementById("editCategory").value = category;
        document.getElementById("editQuantity").value = quantity;
        document.getElementById("editPrice").value = price;
        document.getElementById("editDescription").value = description;
    }


    function openEditForm(productId) {
        console.log('Opening edit form for product ID:', productId);
        fetchProductDetails(productId)
            .then(product => {
                console.log('Product details:', product);
                // Populate form fields with fetched product details
                document.getElementById("editProductId").value = product.id;
                document.getElementById("editName").value = product.name;
                document.getElementById("editCategory").value = product.category;
                document.getElementById("editQuantity").value = product.quantity;
                document.getElementById("editPrice").value = product.price;
                document.getElementById("editDescription").value = product.description;

                // Display the edit form
                document.getElementById("editProductForm").style.display = "block";
            })
            .catch(error => console.error('Error fetching product details:', error));
    }

    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";
    }

    async function fetchProductDetails(productId) {
        const response = await fetch(`fetch_product_details.php?id=${productId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch product details');
        }
        return await response.json();
    }

    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            fetch(`delete_product.php?id=${productId}`, {
                    method: 'DELETE',
                })
                .then(response => {
                    if (response.ok) {
                        // Optionally, remove the deleted row from the table
                        // Reload or update the product listing as needed
                        console.log(`Product with ID ${productId} deleted successfully.`);
                    } else {
                        throw new Error('Failed to delete product');
                    }
                })
                .catch(error => console.error('Error deleting product:', error));
        }
    }

    // Check if the URL contains the 'update' parameter with the value 'success'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('update') === 'success') {
        alert("Product updated successfully.");
    }
</script>