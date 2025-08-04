  <!-- OUR ROOMS -->
  <div class="col-lg-9 col-md-12 px-4">
      <?php
        // $roomsData = $this->session->userdata('roomsData');
        foreach ($allRoomsData as $key => $room) { ?>
          <div class="card mb-4 border-0 shadow">
              <div class="row g-0 p-3 align-items-center">
                  <!-- Rooms Image -->
                  <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                      <img src="<?= base_url('assets/images/rooms/' . $room['image']) ?>" class="img-fluid rounded" alt="">
                  </div>

                  <div class="col-md-5 px-lg-3 px-md-3 px-0">
                      <h5 class="mb-3"><?= $room['room_name']; ?></h5>
                      <!-- Rooms Features -->
                      <div class="features mb-3">
                          <h6 class="mb-1">
                              <i class="bi bi-tools me-1 text-warning"></i> Features
                          </h6>
                          <?php if (!empty($room['features'])):
                                foreach ($room['features'] as $feature): ?>
                                  <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($feature['feature_name']) ?></span>
                              <?php endforeach;
                            else: ?>
                              <span class="badge bg-light text-dark text-wrap">N/A</span>
                          <?php endif; ?>
                      </div>

                      <!-- Rooms Facilities -->
                      <div class="facilities mb-3">
                          <h6 class="mb-1">
                              <i class="bi bi-wrench-adjustable-circle me-1 text-success"></i> Facilities
                          </h6>
                          <?php if (!empty($room['facilities'])):
                                foreach ($room['facilities'] as $facility): ?>
                                  <span class="badge bg-light text-dark text-wrap"><?= htmlspecialchars($facility['facility_name']) ?></span>
                              <?php endforeach;
                            else: ?>
                              <span class="badge bg-light text-dark text-wrap">N/A</span>
                          <?php endif; ?>
                      </div>

                      <!-- Rooms Gueste -->
                      <div class="gueste">
                          <h6 class="mb-1">
                              <i class="bi bi-people-fill me-1 text-primary"></i> Guests
                          </h6>
                          <span class="badge bg-light text-dark text-wrap">
                              <?= htmlspecialchars($room['adult']) ?> Adults
                          </span>
                          <span class="badge bg-light text-dark text-wrap">
                              <?= htmlspecialchars($room['children']) ?> Children
                          </span>
                      </div>

                  </div>
                  <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                      <h6 class="mb-4">₹<?= htmlspecialchars($room['price']) ?> Per Night</h6>
                      <?php
                        $data = $this->session->userdata('data');
                        if (isset($data['shutdown']) && $data['shutdown'] != 1):
                            $CI = &get_instance();
                            $loggedUser = $CI->session->userdata('loggedInuser');
                            $userLogin = 0;
                            if ($loggedUser && $loggedUser['USER_LOGGEDIN'] == true) {
                                $userLogin = 1;
                            }
                        ?>
                          <button onclick="checkLoginToBook(<?= $userLogin ?>,<?= $room['id'] ?>)" class="btn btn-sm w-100 text-white shadow-none custom-bg mb-2 "> <i class="bi bi-calendar-check-fill me-1"></i> Book Now</button>
                      <?php else: ?>
                          <button class="btn btn-sm btn-secondary shadow-none mb-2" disabled> <i class="bi bi-lock-fill me-1"></i> Booking Closed</button>
                      <?php endif; ?>

                      <a href="<?= base_url('room-details/' . $room['id']); ?>" class="btn btn-sm w-100 btn-outline-dark shadow-none">
                          <i class="bi bi-info-circle-fill me-1"></i> More Details
                      </a>

                  </div>
              </div>
          </div>
      <?php }
        ?>
  </div>