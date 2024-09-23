<?php
include('./includes/header.php');

// Include database connection
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission for adding users
    if (isset($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"], $_POST["role"])) {
        $firstName = $mysqli->real_escape_string($_POST["firstName"]);
        $lastName = $mysqli->real_escape_string($_POST["lastName"]);
        $email = $mysqli->real_escape_string($_POST["email"]);
        $phone = isset($_POST["phone"]) ? $mysqli->real_escape_string($_POST["phone"]) : '';
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $role = $mysqli->real_escape_string($_POST["role"]);

        // Insert user into the database
        $sql = "INSERT INTO user (username, lastName, email, phone_number, user_password, role) 
                VALUES ('$firstName', '$lastName', '$email', '$phone', '$password', '$role')";

        if ($mysqli->query($sql)) {
            echo "User added successfully.";
        } else {
            echo "Error adding user: " . $mysqli->error;
        }
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>
        <main id="customers" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <table class="table table-striped table-hover">
                <thead>
                    <h2 class="orderh2">Users list</h2>
                    <tr>
                        <th scope="col">Customer ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch users from the database
                    $sql = "SELECT * FROM user";
                    $result = $mysqli->query($sql);

                    // Display users in the table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['id'] . "</th>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['lastName'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>";
                        echo  " <button type='button' class='btn please btn-primary' onclick='editUser(" . $row['id'] . ", \"" . $row['username'] . "\", \"" . $row['lastName'] . "\", \"" . $row['email'] . "\", \"" . $row['phone_number'] . "\", \"" . $row['user_password'] . "\", \"" . $row['role'] . "\")'>Edit </button>";
                        echo "<button type='button' class='btn btn-secondary' onclick='viewUser(" . $row['id'] . ", \"" . $row['username'] . "\", \"" . $row['lastName'] . "\", \"" . $row['email'] . "\", \"" . $row['phone_number'] . "\", \"" . $row['role'] . "\")'>View</button>";

                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-outline-success" onclick="addUser()">Add User</button>

            <div class="customer-details">



                <form id="addUserForm" action="customers.php" method="POST" style="display: none;">
                    <h2 class="orderh2 cust2">Add New User</h2>
                    <div class="mb-3">
                        <label for="newFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" id="newFirstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="newLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="newLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="newEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="newPhone">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newRole" class="form-label">Role</label>
                        <select class="form-control" name="role" id="newRole" required>
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>

            <!-- Edit user form -->
            <form id="editUserForm" action="editUser.php" method="POST" style="display: none;">
                <h2 class="orderh2 cust2">Update User</h2>
                <input type="hidden" name="editUserId" id="editUserId">
                <div class="mb-3">
                    <label for="editFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="editFirstName" id="editFirstName" required>
                </div>
                <div class="mb-3">
                    <label for="editLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="editLastName" id="editLastName" required>
                </div>
                <div class="mb-3">
                    <label for="newEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="editEmail" id="editEmail" required>
                </div>
                <div class="mb-3">
                    <label for="newPhone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="editPhone" id="editPhone">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="editPassword" id="editPassword" required>
                </div>
                <div class="mb-3">
                    <label for="newRole" class="form-label">Role</label>
                    <select class="form-control" name="editRole" id="editRole" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 150px;">Update User</button>
                <button type="button" class="btn btn-secondary" onclick="closeForm('editUserForm')">Close</button>
            </form>
            <!-- Add View User Form -->
            <form id="viewUserForm" style="display: none;">
                <h2 class="orderh2 cust2">View User Details</h2>
                <div class="mb-3">
                    <label for="viewUserId" class="form-label">User ID:</label>
                    <input type="text" class="form-control" id="viewUserId" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewFirstName" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="viewFirstName" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewLastName" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="viewLastName" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewEmail" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="viewEmail" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewPhone" class="form-label">Phone:</label>
                    <input type="tel" class="form-control" id="viewPhone" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewRole" class="form-label">Role:</label>
                    <input type="text" class="form-control" id="viewRole" readonly>
                </div>
                <button type="button" class="btn btn-secondary" onclick="closeForm('viewUserForm')">Close</button>
            </form>



        </main>
    </div>
</div>

<script>
    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";
    }

    function editUser(id, firstName, lastName, email, phone, password, role) {
        document.getElementById("addUserForm").style.display = "none";
        document.getElementById("editUserForm").style.display = "block";
        document.getElementById("editUserId").value = id;
        document.getElementById("editFirstName").value = firstName;
        document.getElementById("editLastName").value = lastName;
        document.getElementById("editEmail").value = email;
        document.getElementById("editPhone").value = phone;
        document.getElementById("editPassword").value = password;
        document.getElementById("editRole").value = role;
    }

    function viewUser(id, firstName, lastName, email, phone, role) {
        document.getElementById("viewUserId").value = id;
        document.getElementById("viewFirstName").value = firstName;
        document.getElementById("viewLastName").value = lastName;
        document.getElementById("viewEmail").value = email;
        document.getElementById("viewPhone").value = phone;
        document.getElementById("viewRole").value = role;

        document.getElementById("viewUserForm").style.display = "block";
    }

    function addUser() {
        document.getElementById("addUserForm").style.display = "block";
        document.getElementById("addUserForm").reset();
    }

    // Check if the URL contains the 'update' parameter with the value 'success'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('update') === 'success') {
        alert("User updated successfully.");
    }
</script>