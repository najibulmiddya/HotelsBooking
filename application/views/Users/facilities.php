<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br>
        Beatae reiciendis repudiandae a dolores nam, porro unde deserunt velit tempore quam.</p>
</div>

<div class="container">
    <div class="row">

        <?php
        if ($data) {
            $path=FACILIITIES_IMAGE_SITE_PATH;
            foreach ($data as $key => $val) {
        ?>
                <div class="col-lg-4 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded p-4 shadow border-top border-4 border-dark pop">
                        <img src="<?=$path.$val['icon']?>" width="40px">
                        <div class="d-inline-block mb-2">
                            <h5 class="m-0 ms-3"><?=$val['facility_name']?></h5>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Labore recusandae tempora soluta illum, error sit necessitatibus!
                        </p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo"<p>No facilities found.</p>";
        }
        ?>
    </div>
</div>