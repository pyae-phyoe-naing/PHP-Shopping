<?php
require "init.php";
if (isset($_GET['slug'])) {
  $result = getSingle("SELECT *,
                      (SELECT categories.name FROM categories WHERE categories.id=products.category_id) as cat_name 
                      FROM products
                       WHERE  slug=?", [$_GET['slug']]);
  if (!$result) {
    back('errorModal', 'လက်မဆော့ပါနဲ့', 'index.php');
  }
} else {
  back('errorModal', 'Product not found!', 'index.php');
}
require "layout/header.php";

?>

<!--================Single Product Area =================-->
<div class="product_image_area mb-4 pt-0">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-5 text-center pt-3">
        <img height='300' class="mt-5"  src="<?php echo BASE_URL . 'admin/assets/images/products/' . $result->image; ?>" alt="">
      </div>
      <div class="col-lg-6 offset-lg-1">
        <div class="s_product_text">
          <h3><?php echo escape($result->name); ?></h3>
          <h2><?php echo escape($result->price); ?> MMK</h2>
          <ul class="list">
            <li><a href="#"><span>Category</span> : <?php echo escape($result->cat_name); ?></a></li>
            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
          </ul>
          <p><?php echo escape($result->description); ?></p>
          <form action="addtoCart.php" method='post'>
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
            <input type="hidden" name='id' value='<?php echo escape($result->id); ?>'>
            <div class="product_count">
              <label for="qty">Quantity:</label>
              <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
              <button class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
              <button  class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
            </div>
            <div class="card_area d-flex align-items-center">
              <button class="primary-btn border-0" href="#">Add to Cart</button>
              <a class="primary-btn" href="index.php">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--================End Single Product Area =================-->


<?php require "layout/footer.php"; ?>