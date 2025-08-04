<section class="my-3 px-4">
    <div class="text-center">
        <h2 class="fw-bold h-font"> <i class="bi bi-info-circle-fill text-primary me-2"></i> About Us</h2>
        <div class="mx-auto my-2" style="width: 80px; height: 3px; background-color: #000;"></div>
        <p class="text-muted mt-3 mx-auto" style="max-width: 700px;">
            We are committed to delivering exceptional hospitality experiences. Our dedicated team ensures comfort, quality, and outstanding service for every guest.<br>
            Discover why hundreds choose us every day for business and leisure stays.
        </p>
    </div>
</section>


<div class="container my-5">
  <div class="row align-items-center justify-content-between">

    <!-- Text Column -->
    <div class="col-lg-6 col-md-6 mb-4 order-2 order-md-1">
      <h3 class="mb-3 fw-bold">
        <i class="bi bi-building"></i> Discover Comfort & Luxury
      </h3>
      <p class="text-muted">
        <i class="bi bi-check2-circle text-success me-2"></i>
        Experience exceptional hospitality and personalized service.
        <br>
        <i class="bi bi-check2-circle text-success me-2"></i>
        Perfect for business or leisure stays.
        <br>
        <i class="bi bi-check2-circle text-success me-2"></i>
        Elegant rooms, top-class amenities, and great service.
      </p>
    </div>

    <!-- Image Column -->
    <div class="col-lg-5 col-md-6 mb-4 order-1 order-md-2">
      <img 
        src="<?= base_url('assets/images/about/about.jpg') ?>" 
        alt="Hotel About Us" 
        class="w-100 rounded shadow-sm"
      >
    </div>

  </div>
</div>



<div class="container mt-5">
    <?php
    $stats = [
        [
            'icon' => 'customers.svg',
            'count' => $data['total_users'],
            'label' => 'CUSTOMERS'
        ],
        [
            'icon' => 'hotel.svg',
            'count' => $data['total_rooms'],
            'label' => 'Rooms'
        ],
        [
            'icon' => 'rating.svg',
            'count' => $data['total_review'],
            'label' => 'Reviews'
        ],
        [
            'icon' => 'staff.svg',
            'count' => $data['total_staffs'],
            'label' => 'Staffs'
        ],
    ];
    ?>

    <div class="row">
        <?php foreach ($stats as $stat): ?>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="<?= base_url('assets/images/about/' . $stat['icon']) ?>" width="70" alt="<?= $stat['label'] ?>">
                    <h5 class="mt-3"><?= $stat['count'] ?>+ <?= strtoupper($stat['label']) ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<h3 class="my-5 fw-bold h-font text-center"> <i class="bi bi-people-fill text-primary me-2"></i> MANAGEMENT TEAMS</h3>
<div class="container px-4">
    <!-- Swiper -->
    <div class="swiper MANAGEMENT-TEAMS">
        <div class="swiper-wrapper mb-5">
            <?php
            foreach ($team_members as $key => $val) {
            ?>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="<?= TEAM_IMAGE_SITE_PATH . $val->picture ?>" class="w-100">
                    <h5 class="mt-2"><?= $val->name ?></h5>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>