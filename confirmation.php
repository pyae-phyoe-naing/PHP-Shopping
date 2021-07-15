<?php
require "init.php";

if (!isset($_SESSION['user'])) {
	back('errorModal', 'Order ပို့ရန် အကောင့် အရင် ဝင်ပေးပါ', 'login.php');
}
if(!isset($_SESSION['success']) AND empty($_SESSION['success'])){
    back('errorModal', 'ဝယ်ယူမည့် product ကို အရင်ရွေးချယ်ပေးပါ', 'index.php');
}
require "layout/header.php";

?>

<!--================Order Details Area =================-->
<section class="order_details section_gap">
	<div class="container">
		<h3 class="title_confirmation">Thank you. Your order has been received.</h3>
		<p class="text-center">
			<a href="<?php echo BASE_URL; ?>index.php" class="primary-btn btn text-white" style="border-radius: 0;">Ok Thank!</a>

		</p>
	</div>
</section>
<!--================End Order Details Area =================-->

<?php require "layout/footer.php"; ?>

</body>

</html>