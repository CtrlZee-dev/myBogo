<?php include('./includes/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php'); ?>

    <main id="dashboard" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="dash-buttons">

        <!-- <div class="btn-salesTotal"> -->
        <button type="button" id="btn-dash" class="btn btn-primary btn-lg">Total Donations <p>R13 452,00</p></button>

        <button type="button" id="btn-dash" class="btn  btn-primary btn-lg">Total Sales <p>R19 222,10</p></button>
        <!-- <div class="btn-CustOrder"> -->

        <button type="button" id="btn-dash" class="btn  btn-primary btn-lg">Customers <p>122</p></button>

        <button type="button" id="btn-dash" class="btn btn-primary btn-lg"> Orders <p>3</p></button>

      </div>
      <div class="dash-tbls">
        <div class="recent-orders recent">
          <h2>Recent Orders</h2>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">12345</th>
                <td>John Doe</td>
                <td>2024-05-30</td>
                <td>Pending</td>
                <td>$150.00</td>
                <td>
                  <button type="button" class="btn btn-primary"> Edit</button>
                  <button type="button" class="btn btn-secondary">View</button>
                </td>
              </tr>
              <tr>
                <th scope="row">12346</th>
                <td>Jane Smith</td>
                <td>2024-05-29</td>
                <td>Complete</td>
                <td>$200.00</td>
                <td>
                  <button type="button" class="btn btn-primary"> Edit</button>
                  <button type="button" class="btn btn-secondary">View</button>
                </td>
              </tr>
              <!-- Add more rows for additional recent orders -->
            </tbody>
          </table>
        </div>
        <div class="recent-donations recent">
          <h2>Donations</h2>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Donor Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>John Doe</td>
                <td>$100</td>
                <td>2024-05-30</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jane Smith</td>
                <td>$50</td>
                <td>2024-05-29</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Michael Johnson</td>
                <td>$200</td>
                <td>2024-05-28</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>




    </main>


  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>