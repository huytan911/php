<?php
$query = "SELECT * FROM brand WHERE status";
$result = $conn->query($query);
?>
<?php foreach ($result as $item) : ?>
  <section><a href="?option=showproduct&brandid=<?= $item['id'] ?>"></a></section>
<?php endforeach; ?>

<div class="col-lg-3">
  <button class="btn btn-outline-secondary mb-5 w-100 d-lg-none" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span>Show filter</span>
  </button>
  <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button text-dark bg-light" type="button" data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
            Hãng sản phẩm
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
          <div class="accordion-body">
            <div>
              <?php foreach ($result as $item) : ?>
                <div class="form-control">
                  <a href="?option=showproduct&brandid=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                  <span class="badge badge-secondary float-end">
                    <?= mysqli_num_rows($conn->query("SELECT * FROM product WHERE brandid=" . $item['id'])) ?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <form>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button text-dark bg-light" type="button" data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
              Mức giá
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
            <div class="accordion-body">
              <div class="row mb-3">
                <div class="col-6">
                  <input type="hidden" name="option" value="showproduct">
                  <section><input type="radio" name="range" value="0 and 1000000" <?=(isset($_GET['range']) && $_GET['range'] == "0 and 1000000") ? 'checked':''?>/> dưới 1 triệu</section>
                  <section><input type="radio" name="range" value="1000000 and 5000000" <?=(isset($_GET['range']) && $_GET['range'] == "1000000 and 5000000") ? 'checked':''?>/> từ 1-5 triệu</section>
                  <section><input type="radio" name="range" value="5000000 and 10000000" <?=(isset($_GET['range']) && $_GET['range'] == "5000000 and 10000000") ? 'checked':''?>/> từ 5-10 triệu</section>
                  <section><input type="radio" name="range" value="10000000 and 30000000" <?=(isset($_GET['range']) && $_GET['range'] == "10000000 and 30000000") ? 'checked':''?>/> từ 10-30 triệu</section>
                  <section><input type="radio" name="range" value="30000000 and 50000000" <?=(isset($_GET['range']) && $_GET['range'] == "30000000 and 50000000") ? 'checked':''?>/> từ 30-50 triệu</section>
                </div>
              </div>
              <button type="submit" class="btn btn-white w-100 border border-secondary">Áp dụng</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>