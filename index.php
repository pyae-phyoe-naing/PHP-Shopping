<?php
require 'init.php';

## For search Paginate Set Cookie
if (empty($_POST['search'])) {
	if (empty($_GET['pageno'])) {
		unset($_COOKIE['search']);
		setcookie('search', null, -1, '/');
	}
} else {
	setcookie('search', $_POST['search'], time() + (8600 * 30), "/");
}

## for paginate
if (!empty($_GET["pageno"])) {
	$pageno = $_GET["pageno"];
} else {
	$pageno = 1;
}
$numOfrecord = 6;
$offset = ($pageno - 1) * $numOfrecord;
## get product
if (empty($_POST["search"]) && empty($_COOKIE['search'])) {
	## check category by product or all product
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
		## check exit category id
		$cur_cat = getSingle("select * from categories where id=?", [$id]);
		if ($cur_cat) {
			$rawResult = getAll("SELECT * FROM products WHERE category_id=? ORDER BY id DESC", [$id]);
			$total_pages = ceil(count($rawResult) / $numOfrecord);
			$result = getAll("SELECT * FROM products WHERE category_id=? ORDER BY id DESC LIMIT $offset,$numOfrecord ", [$id]);
		} else {
			back('errorModal', 'လက်မဆော့ပါနဲ့', 'index.php');
			//echo "<script>window.location.href='index.php'</script>";
		}
	} else {
		$rawResult = getAll("SELECT * FROM products ORDER BY id DESC");
		$total_pages = ceil(count($rawResult) / $numOfrecord);
		$result = getAll("SELECT * FROM products  ORDER BY id DESC LIMIT $offset,$numOfrecord ");
	}
} else {
	$searchKey = empty($_POST['search']) ? $_COOKIE['search'] : $_POST['search'];
	$rawResult = getAll("SELECT * FROM products WHERE name LIKE '%$searchKey%' or description LIKE '%$searchKey%' ORDER BY id DESC");
	$total_pages = ceil(count($rawResult) / $numOfrecord);
	$result = getAll("SELECT * FROM products  WHERE name LIKE '%$searchKey%' or description LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecord ");
}
## 1 qty add cart home page
if (isset($_GET['slug']) and !empty($_GET['slug'])) {
	$slug = $_GET['slug'];
	$product = getSingle("select * from products where slug='$slug'");
	$product_qty = $product->quantity;
	$product_id = $product->id;
	if (isset($_SESSION['cart']['id-' . $product_id])) {
		$old_qty = $_SESSION['cart']['id-' . $product_id];
		$add_qty =  $old_qty + 1;
		// check add qty amount > product qty
		if ($add_qty > $product_qty) {
			## if > set session old qty value
			$_SESSION['cart']['id-' . $product_id] = $old_qty;
			back('errorModal', 'Product အလုံအလောက်မရှိတော့ပါ !', 'index.php');
		} else {
			## if not > set session old + new qty
			$_SESSION['cart']['id-' . $product_id] += 1;
		}
	} else {
		$_SESSION['cart']['id-' . $product_id] = 1;
	}
	back('success', 'Add to cart ', 'index.php');
}
require 'layout/header.php';

?>
<!-- End Banner Area -->
<div class="container">
	<div class="row">
		<!-- Side bar area start-->
		<div class="col-xl-3 col-lg-4 col-md-5">
			<div class="sidebar-categories">
				<div class="head">Browse Categories</div>
				<ul class="main-categories">
					<!-- loop category -->
					<?php
					$cats = getAll(" SELECT *,
									(SELECT COUNT(id) from products WHERE products.category_id=categories.id) as product_count
									FROM categories");
					foreach ($cats as $cat) {
					?>
						<li class="main-nav-list">
							<a href="index.php?id=<?php echo $cat['id']; ?>">
								<span class="lnr lnr-arrow-right"></span><?php echo escape($cat['name']); ?>
								<span class="badge  float-right mt-3 text-white" style="background-color: #ffb300;;"><?php echo $cat['product_count']; ?></span>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- Side bar area end-->
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Pagination Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center mb-3">
				<div class="pagination">
					<a href="?pageno=1" class="active">First</a>
					<a href="<?php echo $pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1); ?>" class="prev-arrow <?php echo $pageno <= 1 ? 'disabled' : '' ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<a href="#" class="active"><?php echo $pageno; ?></a>
					<a href="<?php echo $pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1);  ?>" class="next-arrow <?php echo $pageno >= $total_pages ? 'disabled' : ''; ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					<a href="?pageno=<?php echo $total_pages; ?>" class="active">Last</a>
				</div>
			</div>
			<!-- End Pagination Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<!-- loop product -->
					<?php
					if ($result) {
						$i = 1;
						foreach ($result as $value) {
							## Get category join   
							$cat = getSingle('select * from categories where id=?', [$value['category_id']]);

					?>
							<div class="col-lg-4 col-md-6">
								<div class="single-product card border-0 shadow">
									<div class="card-body">
										<p class="text-center">
											<img height="115" class="w-50" src="<?php echo BASE_URL . 'admin/assets/images/products/' . $value['image']; ?>" alt="">
										</p>
										<div class="product-details">
											<h6><?php echo $value['name'] ?></h6>
											<div class="price">
												<h6><?php echo $value['price'] ?> MMK</h6>
											</div>
											<div class="prd-bottom">

												<a href="<?php echo BASE_URL . 'index.php?slug=' . $value['slug']; ?>" class="social-info">
													<span class="ti-bag"></span>
													<p class="hover-text">add to bag</p>
												</a>
												<a href="<?php echo BASE_URL; ?>product_detail.php?slug=<?php echo $value['slug']; ?>" class="social-info">
													<span class="lnr lnr-move"></span>
													<p class="hover-text">view more</p>
												</a>
												<span class="float-right badge badge-info px-2 py-1" style="color:#f5f5f5"><?php echo $cat->name; ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
					<!-- loop product end -->
				</div>
			</section>
			<!-- End Best Seller -->
			<?php require 'layout/footer.php'; ?>

			</body>

			</html>