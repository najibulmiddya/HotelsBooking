<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="mb-0"> <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard</h3>

  <?php if ($data['is_shutdown']['shutdown'] == 1): ?>
    <div class="text-danger fw-semibold">
      <i class="bi bi-exclamation-triangle-fill me-1"></i>
      System is in shutdown mode.
    </div>
  <?php endif; ?>
</div>

<!-- Booking Statistics Cards -->
<div class="row g-4 mb-4">

  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Total Bookings</h6>
          <h3 class="text-primary"><?= $data['current_bookings']['total_booking'] ?></h3>
        </div>
        <i class="bi bi-bookmark-check-fill display-6 text-primary"></i>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Processed Refunds</h6>
          <h3 class="text-success">&#8377;<?= $data['current_bookings']['refund_revenue'] ?></h3>
        </div>
        <i class="bi bi-arrow-counterclockwise display-6 text-success"></i>
      </div>
    </div>
  </div>


  <!-- Cancelled Revenue -->
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Revenue Refunded</h6>
          <h3 class="text-warning">&#8377;<?= $data['current_bookings']['refunded_revenue'] ?></h3>
        </div>
        <i class="bi bi-arrow-repeat display-6 text-warning"></i>
      </div>
    </div>
  </div>

  <!-- Total Revenue -->
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Total Revenue</h6>
          <h3 class="text-danger">&#8377;<?= $data['current_bookings']['total_revenue'] ?></h3>
        </div>
        <i class="bi bi-currency-rupee display-6 text-danger"></i>
      </div>
    </div>
  </div>


  <!-- New Bookings -->
  <div class="col-md-3">
    <a href="<?= base_url('admin/bookings') ?>" class="text-decoration-none">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">New Bookings</h6>
            <h3 class="text-primary"><?= $data['current_bookings']['new_bookings'] ?></h3>
          </div>
          <i class="bi bi-calendar2-check display-6 text-primary"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Refund Booking -->
  <div class="col-md-3">
    <a href="<?= base_url('admin/refund-bookings') ?>" class="text-decoration-none">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">Refund Booking</h6>
            <h3 class="text-success"><?= $data['current_bookings']['refund_bookings'] ?></h3>
          </div>
          <i class="bi bi-arrow-counterclockwise display-6 text-success"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Users Queries -->
  <div class="col-md-3">
    <a href="<?= base_url('users-queries') ?>" class="text-decoration-none">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">User Queries</h6>
            <h3 class="text-warning"><?= $data['unread_queries']['count'] ?></h3>
          </div>
          <i class="bi bi-question-circle-fill display-6 text-warning"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Users Review -->
  <div class="col-md-3">
    <a href="<?= base_url('admin/room-rate-review') ?>" class="text-decoration-none">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h6 class="text-uppercase fw-bold text-secondary">User Reviews</h6>
            <h3 class="text-danger"><?= $data['unread_reviews']['count'] ?></h3>
          </div>
          <i class="bi bi-chat-dots-fill display-6 text-danger"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Total Users -->
  <div class="col-md-3">
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Total Users</h6>
          <h3 class="text-primary"><?= $data['users']['total'] ?></h3>
        </div>
        <i class="bi bi-people-fill display-6 text-primary"></i>
      </div>
    </div>
  </div>

  <!-- Active Users -->
  <div class="col-md-3">
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Active Users</h6>
          <h3 class="text-success"><?= $data['users']['active'] ?></h3>
        </div>
        <i class="bi bi-person-check-fill display-6 text-success"></i>
      </div>
    </div>
  </div>

  <!-- Inactive Users -->
  <div class="col-md-3">
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Inactive Users</h6>
          <h3 class="text-warning"><?= $data['users']['inactive'] ?></h3>
        </div>
        <i class="bi bi-person-x-fill display-6 text-warning"></i>
      </div>
    </div>
  </div>

  <!-- Unverified Users -->
  <div class="col-md-3">
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Unverified Users</h6>
          <h3 class="text-danger"><?= $data['users']['unverified'] ?></h3>
        </div>
        <i class="bi bi-shield-exclamation display-6 text-danger"></i>
      </div>
    </div>
  </div>

  <!-- Total Rooms -->

  <!-- <div class="col-md-3">
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase fw-bold text-secondary">Total Rooms</h6>
          <h3 class="text-primary"><?= $data['total_rooms']['count'] ?></h3>
        </div>
        <i class="bi bi-house-fill display-6 text-primary"></i>
      </div>
    </div>
  </div> -->

</div>



<div class="row mt-3" id="chartTotals">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h6 class="fw-bold mb-3">
          <i class="bi bi-bar-chart-steps me-2"></i>Booking & Revenue Summary
        </h6>
        <div class="row text-muted small">
          <div class="col-md-2">Total Bookings: <span id="totalBookings">0</span></div>
          <div class="col-md-2">Cancelled Bookings: <span id="cancelledBookings">0</span></div>
          <div class="col-md-2">Total Revenue: ₹<span id="totalRevenue">0.00</span></div>
          <div class="col-md-2">Processed Refunds: ₹<span id="processedRefunds">0.00</span></div>
          <div class="col-md-2">Refunded: ₹<span id="refundedRevenue">0.00</span></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Booking & Revenue Analytics Section -->
<div class="shadow p-2">

  <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">

    <!-- Heading -->
    <h5 class="">
      <i class="bi bi-graph-up-arrow text-primary me-2"></i>
      Booking & <span class="text-success">Revenue</span> Analytics
    </h5>

    <!-- Start Date -->
    <input type="text" id="filterStartDate" class="form-control form-control shadow-none text-dark bg-white" placeholder="Start Date" autocomplete="off" style="max-width: 120px;">

    <!-- End Date -->
    <input type="text" id="filterEndDate" class="form-control form-control shadow-none text-dark bg-white" placeholder="End Date" autocomplete="off" style="max-width: 120px;">

    <!-- Apply -->
    <button id="applyFilter" class="btn btn btn-primary shadow-none">
      <i class="bi bi-funnel-fill"></i> Filter
    </button>

    <!-- Reset -->
    <button id="resetFilter" class="btn btn-secondary shadow-none">
      <i class="bi bi-arrow-clockwise"></i> Reset
    </button>

    <!-- View Mode -->
    <select id="chartViewMode" class="form-select form-select shadow-none" style="max-width: 190px;">
      <option value="day">Daily</option>
      <option value="week">Weekly</option>
      <option value="month" selected>Monthly</option>
      <option value="year">Yearly</option>
      <option value="all">All Time</option>
    </select>

  </div>

  <div class="row g-4 mb-2">
    <!-- Booking Chart -->
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="mb-3 fw-bold">
            <i class="bi bi-bar-chart-fill me-2"></i>Bookings Analytics
          </h6>
          <canvas id="bookingChart" height="150"></canvas>
          <div id="bookingDateRange" class="text-muted small text-center mt-2"></div>
        </div>
      </div>
    </div>

    <!-- Revenue Chart -->
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="mb-3 fw-bold">
            <i class="bi bi-currency-rupee me-2"></i>Revenue Analytics
          </h6>
          <canvas id="revenueChart" height="150"></canvas>
          <div id="revenueDateRange" class="text-muted small text-center mt-2"></div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- Booking & Revenue Analytics Section End -->

<!-- Profile/Admin Info -->
<div class="row g-4 mt-2">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <img src="<?= USER_PROFILE_SITE_PATH . '1498_NajibulMiddya.jpg' ?>" class="rounded-circle border shadow"
          style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;" alt="Admin" />
        <h5 class="mb-0"><?= $_SESSION['loggedInAdmin']['name'] ?? ''; ?></h5>
        <p class="text-muted"><?= $_SESSION['loggedInAdmin']['email'] ?? ''; ?></p>
        <span class="badge bg-success">Online</span>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('#js-alert').hide();
  })
</script>

<script>
  // function renderCharts(viewMode) {
  //   let labels = [];
  //   const confirmed = [],
  //     cancelled = [],
  //     newBookings = [],
  //     total_revenue = [],
  //     processed_refunds = [],
  //     refunded_revenue = [];

  //   if (viewMode === 'all') {
  //     // Aggregate all data into a single label
  //     labels = ['All Time'];
  //     const filtered = chartData;

  //     confirmed.push(filtered.reduce((sum, d) => sum + parseInt(d.confirmed_bookings || 0), 0));
  //     cancelled.push(filtered.reduce((sum, d) => sum + parseInt(d.cancelled_bookings || 0), 0));
  //     newBookings.push(filtered.reduce((sum, d) => sum + parseInt(d.new_bookings || 0), 0));

  //     total_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.total_revenue || 0), 0));
  //     processed_refunds.push(filtered.reduce((sum, d) => sum + parseFloat(d.processed_refunds || 0), 0));
  //     refunded_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.refunded_revenue || 0), 0));
  //   } else {
  //     // Unique labels based on selected viewMode
  //     labels = [...new Set(chartData.map(d => d[viewMode]))];

  //     labels.forEach(label => {
  //       const filtered = chartData.filter(d => d[viewMode] == label);

  //       confirmed.push(filtered.reduce((sum, d) => sum + parseInt(d.confirmed_bookings || 0), 0));
  //       cancelled.push(filtered.reduce((sum, d) => sum + parseInt(d.cancelled_bookings || 0), 0));
  //       newBookings.push(filtered.reduce((sum, d) => sum + parseInt(d.new_bookings || 0), 0));

  //       total_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.total_revenue || 0), 0));
  //       processed_refunds.push(filtered.reduce((sum, d) => sum + parseFloat(d.processed_refunds || 0), 0));
  //       refunded_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.refunded_revenue || 0), 0));
  //     });
  //   }

  //   // Format labels
  //   const formattedLabels =
  //     viewMode === 'week' ?
  //     labels.map(w => 'W' + w.slice(4) + ' - ' + w.slice(0, 4)) :
  //     viewMode === 'day' ?
  //     labels.map(d => {
  //       const [y, m, d2] = d.split('-');
  //       return `${d2}-${m}-${y}`;
  //     }) :
  //     viewMode === 'month' ?
  //     labels.map(m => {
  //       const [y, m2] = m.split('-');
  //       return `${m2}-${y}`;
  //     }) :
  //     labels; // year or all (just show raw labels)

  //   if (window.Chart && typeof bookingChart?.destroy === 'function') bookingChart.destroy();
  //   if (window.Chart && typeof revenueChart?.destroy === 'function') revenueChart.destroy();


  //   // Booking Chart
  //   bookingChart = new Chart(document.getElementById('bookingChart'), {
  //     type: 'bar',
  //     data: {
  //       labels: formattedLabels,
  //       datasets: [{
  //           label: 'Confirmed Bookings',
  //           data: confirmed,
  //           backgroundColor: '#198754'
  //         },
  //         {
  //           label: 'Cancelled Bookings',
  //           data: cancelled,
  //           backgroundColor: '#dc3545'
  //         },
  //         {
  //           label: 'New Bookings',
  //           data: newBookings,
  //           backgroundColor: '#0dcaf0'
  //         }
  //       ]
  //     },
  //     options: {
  //       responsive: true,
  //       plugins: {
  //         legend: {
  //           position: 'bottom'
  //         }
  //       },
  //       scales: {
  //         y: {
  //           beginAtZero: true
  //         }
  //       }
  //     }
  //   });

  //   // Revenue Chart
  //   revenueChart = new Chart(document.getElementById('revenueChart'), {
  //     type: 'line',
  //     data: {
  //       labels: formattedLabels,
  //       datasets: [{
  //           label: 'Total Revenue (₹)',
  //           data: total_revenue,
  //           borderColor: '#4caf50',
  //           backgroundColor: 'rgba(76, 175, 80, 0.2)',
  //           fill: true,
  //           tension: 0.3
  //         },
  //         {
  //           label: 'Processed Refunds (₹)',
  //           data: processed_refunds,
  //           borderColor: '#2196f3',
  //           backgroundColor: 'rgba(33, 150, 243, 0.2)',
  //           fill: true,
  //           tension: 0.3
  //         },
  //         {
  //           label: 'Refunded (₹)',
  //           data: refunded_revenue,
  //           borderColor: '#ff9800',
  //           backgroundColor: 'rgba(255, 152, 0, 0.2)',
  //           fill: true,
  //           tension: 0.3
  //         }
  //       ]
  //     },
  //     options: {
  //       responsive: true,
  //       plugins: {
  //         legend: {
  //           position: 'bottom'
  //         }
  //       },
  //       scales: {
  //         y: {
  //           beginAtZero: true,
  //           ticks: {
  //             callback: value => '₹' + value.toLocaleString()
  //           }
  //         }
  //       }
  //     }
  //   });
  // }

  function renderCharts(viewMode, startDate = '', endDate = '') {

    
    let labels = [];
    const confirmed = [],
      cancelled = [],
      newBookings = [];
    const total_revenue = [],
      processed_refunds = [],
      refunded_revenue = [];

    if (viewMode === 'all') {
      labels = ['All Time'];
      const filtered = chartData;

      confirmed.push(filtered.reduce((sum, d) => sum + parseInt(d.confirmed_bookings || 0), 0));
      cancelled.push(filtered.reduce((sum, d) => sum + parseInt(d.cancelled_bookings || 0), 0));
      newBookings.push(filtered.reduce((sum, d) => sum + parseInt(d.new_bookings || 0), 0));

      total_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.total_revenue || 0), 0));
      processed_refunds.push(filtered.reduce((sum, d) => sum + parseFloat(d.processed_refunds || 0), 0));
      refunded_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.refunded_revenue || 0), 0));
    } else {
      labels = [...new Set(chartData.map(d => d[viewMode]))];

      labels.forEach(label => {
        const filtered = chartData.filter(d => d[viewMode] == label);

        confirmed.push(filtered.reduce((sum, d) => sum + parseInt(d.confirmed_bookings || 0), 0));
        cancelled.push(filtered.reduce((sum, d) => sum + parseInt(d.cancelled_bookings || 0), 0));
        newBookings.push(filtered.reduce((sum, d) => sum + parseInt(d.new_bookings || 0), 0));

        total_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.total_revenue || 0), 0));
        processed_refunds.push(filtered.reduce((sum, d) => sum + parseFloat(d.processed_refunds || 0), 0));
        refunded_revenue.push(filtered.reduce((sum, d) => sum + parseFloat(d.refunded_revenue || 0), 0));
      });
    }

    const formattedLabels =
      viewMode === 'week' ? labels.map(w => 'W' + w.slice(4) + ' - ' + w.slice(0, 4)) :
      viewMode === 'day' ? labels.map(d => {
        const [y, m, d2] = d.split('-');
        return `${d2}-${m}-${y}`;
      }) :
      viewMode === 'month' ? labels.map(m => {
        const [y, m2] = m.split('-');
        return `${m2}-${y}`;
      }) : labels;

    let displayRange = '';
    if (startDate && endDate) {
      displayRange = `${startDate} → ${endDate}`;
      $('#bookingDateRange').text(displayRange).show();
      $('#revenueDateRange').text(displayRange).show();
    } else {
      $('#bookingDateRange').hide();
      $('#revenueDateRange').hide();
    }

    if (window.Chart && typeof bookingChart?.destroy === 'function') bookingChart.destroy();
    if (window.Chart && typeof revenueChart?.destroy === 'function') revenueChart.destroy();

    // Booking Chart
    bookingChart = new Chart(document.getElementById('bookingChart'), {
      type: 'bar',
      data: {
        labels: formattedLabels,
        datasets: [{
            label: 'Confirmed Bookings',
            data: confirmed,
            backgroundColor: '#198754'
          },
          {
            label: 'Cancelled Bookings',
            data: cancelled,
            backgroundColor: '#dc3545'
          },
          {
            label: 'New Bookings',
            data: newBookings,
            backgroundColor: '#0dcaf0'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }

    });

    // Revenue Chart
    revenueChart = new Chart(document.getElementById('revenueChart'), {
      type: 'line',
      data: {
        labels: formattedLabels,
        datasets: [{
            label: 'Total Revenue (₹)',
            data: total_revenue,
            borderColor: '#4caf50',
            backgroundColor: 'rgba(76, 175, 80, 0.2)',
            fill: true,
            tension: 0.3
          },
          {
            label: 'Processed Refunds (₹)',
            data: processed_refunds,
            borderColor: '#2196f3',
            backgroundColor: 'rgba(33, 150, 243, 0.2)',
            fill: true,
            tension: 0.3
          },
          {
            label: 'Refunded (₹)',
            data: refunded_revenue,
            borderColor: '#ff9800',
            backgroundColor: 'rgba(255, 152, 0, 0.2)',
            fill: true,
            tension: 0.3
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }

    });
  }


  $(document).ready(function() {
    $.getJSON("<?= base_url('admin/bookings-chart-data') ?>", function(data) {
      chartData = data;
      renderCharts($('#chartViewMode').val());
    });

    $('#chartViewMode').on('change', function() {
      $('#filterStartDate').val('');
      $('#filterEndDate').val('');
      fetchChartData();
      renderCharts($(this).val());
    });


    $('#applyFilter').on('click', function() {
      const start = $('#filterStartDate').val();
      const end = $('#filterEndDate').val();
      if (start && end) {
        fetchChartData(start, end);
      }
    });

    function fetchChartData(start = '', end = '') {
      $.getJSON("<?= base_url('admin/bookings-chart-data') ?>", {
        start_date: start,
        end_date: end
      }, function(data) {
        chartData = data;
        renderCharts($('#chartViewMode').val(), start, end);
      });
    }

    $('#resetFilter').on('click', function() {
      $('#filterStartDate').val('');
      $('#filterEndDate').val('');
      fetchChartData();
    });

  });
</script>

<script>
  let startPicker, endPicker;
  startPicker = flatpickr("#filterStartDate", {
    dateFormat: "d-m-Y",
    maxDate: "today",
    onChange: function(selectedDates, dateStr) {
      if (selectedDates.length > 0) {
        endPicker.set('minDate', selectedDates[0]);
      } else {
        endPicker.set('minDate', null);
      }
    }
  });

  endPicker = flatpickr("#filterEndDate", {
    dateFormat: "d-m-Y",
    maxDate: "today"
  });

</script>