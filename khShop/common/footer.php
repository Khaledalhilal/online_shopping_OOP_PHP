  <?php $footer = $products->getAllFooter();

    ?>
  <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
      <div class="row px-xl-5 pt-5">
          <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
              <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
              <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><?php echo $footer[0]['address'] ?></p>
              <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><?php echo $footer[0]['email'] ?></p>
              <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i><?php echo $footer[0]['phone_number'] ?></p>
          </div>
          <div class="col-lg-8 col-md-12">
              <div class="row">
                  <div class="col-lg col-md-4 mb-5">
                      <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                      <div class="d-flex flex-column justify-content-start">
                          <a class="text-secondary mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                          <a class="text-secondary mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                          <a class="text-secondary mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                      </div>
                  </div>
                  <div class="col-lg col-md-4 mb-5 ">
                      <h6 class="col-lg text-end text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                      <div class="d-flex align-items-right">
                          <a class="btn btn-primary btn-square mr-2 text-right" href="#"><i class="fab fa-twitter"></i></a>
                          <a class="btn btn-primary btn-square mr-2 text-right" href="#"><i class="fab fa-facebook-f"></i></a>
                          <a class="btn btn-primary btn-square mr-2 text-right" href="#"><i class="fab fa-linkedin-in"></i></a>
                          <a class="btn btn-primary btn-square text-right" href="#"><i class="fab fa-instagram"></i></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
          <div class="col-md-6 px-xl-0">
              <p class="mb-md-0 text-center text-md-left text-secondary">
                  &copy; <a class="text-primary" href="#">khaled.com</a>. All Rights Reserved. Designed
                  <span class="text-primary">Khaled Alhilal</span>
              </p>
          </div>

      </div>
  </div>
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>