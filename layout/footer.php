</div>
</div>
</div>



<!-- start footer Area -->
<footer class="footer-area section_gap py-2">
  <div class="container">
    <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
      <p class="footer-text pt-5">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
    </div>
  </div>
</footer>
<!-- End footer Area -->
<script src="https://code.jquery.com/jquery-3.6.0.js?fbclid=IwAR1XX1FcmyPyWTDdlKjSOf1BW7KL0TVE67-xcOXD8b-7bByqS9kVrDd053k"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL ?>asset/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/jquery.nice-select.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/jquery.sticky.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/nouislider.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/owl.carousel.min.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="<?php echo BASE_URL ?>asset/js/gmaps.min.js"></script>
<script src="<?php echo BASE_URL ?>asset/js/main.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>admin/assets/scripts/admin.js"></script>
<?php require 'admin/layout/toast.php';  ?>
<script>
  function logout() {
    Swal.fire({
      text: "Logout ထွက်မှာသေချာပီလား ?",
      icon: 'warning',
      reverseButtons: true,
      confirmButtonText: 'Confirm',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showCancelButton: true,
      preConfirm: () => {
        let url = "<?php echo BASE_URL ?>";
        window.location.href = url + 'logout.php';
      },
    })
  }
</script>