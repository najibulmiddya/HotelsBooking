
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <h3 class="mb-4"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</h3>

  <!-- Dashboard Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">Total Bookings</h6>
            <h3 class="text-primary">125</h3>
          </div>
          <i class="bi bi-journal-check display-6 text-primary"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">Total Users</h6>
            <h3 class="text-success">58</h3>
          </div>
          <i class="bi bi-people-fill display-6 text-success"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">Total Rooms</h6>
            <h3 class="text-warning">22</h3>
          </div>
          <i class="bi bi-house-fill display-6 text-warning"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">Total Revenue</h6>
            <h3 class="text-danger">&#8377;98,500</h3>
          </div>
          <i class="bi bi-currency-rupee display-6 text-danger"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Profile/Admin Info -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <img src="https://via.placeholder.com/100" class="rounded-circle mb-2" alt="Admin" />
          <h5 class="mb-0">Admin Name</h5>
          <p class="text-muted">admin@example.com</p>
          <span class="badge bg-success">Online</span>
        </div>
      </div>
    </div>

    <!-- Revenue Chart -->
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="mb-3 fw-bold">Monthly Revenue</h6>
          <canvas id="revenueChart" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Bookings Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h6 class="mb-3 fw-bold">Recent Bookings</h6>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Booking ID</th>
              <th>Name</th>
              <th>Room</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>BK001</td>
              <td>Rahul Sen</td>
              <td>Deluxe</td>
              <td>2025-07-15</td>
              <td>2025-07-18</td>
              <td><span class="badge bg-success">Confirmed</span></td>
            </tr>
            <tr>
              <td>BK002</td>
              <td>Neha Kumari</td>
              <td>Premium</td>
              <td>2025-07-12</td>
              <td>2025-07-14</td>
              <td><span class="badge bg-warning">Pending</span></td>
            </tr>
            <tr>
              <td>BK003</td>
              <td>Ajay Singh</td>
              <td>Standard</td>
              <td>2025-07-10</td>
              <td>2025-07-12</td>
              <td><span class="badge bg-danger">Cancelled</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js Script -->
<script>
  const ctx = document.getElementById('revenueChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'Revenue (₹)',
        data: [12000, 15000, 18000, 17000, 20000, 22000, 25000],
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script>
   $(document).ready(function() {
      $('#js-alert').hide();
   })
</script>