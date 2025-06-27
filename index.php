<?php include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>D-Moll</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="images.css">
  <link rel="stylesheet" href="item.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class=" col-xxl-12 col-12 col-md-12">
        <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel" style="max-width: 100%; margin-left: auto; margin-right: auto; overflow: hidden;">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://coffeebrewcafe.com/wp-content/uploads/2024/03/Starbucks-Seasonal-Transitions-1536x878.jpg" class="d-block w-100" alt="..." style="width: 100%; height: auto; max-height: 350px; object-fit: fill  ; object-position: center;">
            </div>
            <div class="carousel-item">
              <img src="https://coffeebrewcafe.com/wp-content/uploads/2024/02/Starbucks-Cup-Sizes-%E2%80%93-An-Ultimate-Guide-to-Starbucks-Drink-Sizes-scaled.jpg" class="d-block w-100" alt="..." style="width: 100%; height: auto; max-height: 350px; object-fit: fill; object-position: center;">
            </div>
            <div class="carousel-item">
              <img src="https://coffeebrewcafe.com/wp-content/uploads/2024/03/Starbucks-Cup-Sizes-for-Frappuccino-Find-Yours-scaled.jpg" class="d-block w-100" alt="..." style="width: 100%; height: auto; max-height: 350px; object-fit: fill; object-position: center;">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="Herosection_1">
    <div class="container">
      <h3 class="mt-5 pt-3 text text-success head">Handcrafted Curations</h3>
      <div id="root"></div>
    </div>
  </div>
  <div class="Herosection_2">
    <div class="container">
      <h3 class="mt-2 pt-4 text text-success head">Barista Recommends</h3>
      <div id="root1"></div>
    </div>
  </div>
  <div class="Herosection_3 mt-4 ">
    <div class="container">
      <h3 class="mt-3 pt-4 text text-success head">Learn more about the world of coffee!</h3>
      <div class="card bg-dark text-white mt-4 mb-4" style="position: relative;">
        <img src="https://preprodtsbstorage.blob.core.windows.net/cms/uploads/ICW_Live_Event_Day5_41f11ca3d2.jpg" class="card-img" alt="..." height="400px">
        <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, 0.5); color: white;">
          <h5 class="card-title fs-4 ms-4 head text-white">Art & Science Of Coffee Brewing</h5>
          <p class="card-text ms-4 head">Master the perfect brew with starbucks! Learn the art and science of coffee brewing.</p>
        </div>
      </div>
    </div>
    <footer class="bg-dark text-white pt-5 pb-4 head">
      <div class="container text-center text-md-start">
        <div class="row">

          <!-- About Us -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h5 class="text-uppercase fw-bold text-warning mb-4">About Us</h5>
            <p><a href="#" class="text-white text-decoration-none">Our Heritage</a></p>
            <p><a href="#" class="text-white text-decoration-none">Coffeehouse</a></p>
            <p><a href="#" class="text-white text-decoration-none">Our Company</a></p>
          </div>

          <!-- Responsibility -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h5 class="text-uppercase fw-bold text-warning mb-4">Responsibility</h5>
            <p><a href="#" class="text-white text-decoration-none">Diversity</a></p>
            <p><a href="#" class="text-white text-decoration-none">Community</a></p>
            <p><a href="#" class="text-white text-decoration-none">Ethical Sourcing</a></p>
            <p><a href="#" class="text-white text-decoration-none">Environmental Stewardship</a></p>
            <p><a href="#" class="text-white text-decoration-none">Learn More</a></p>
          </div>

          <!-- Quick Links -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h5 class="text-uppercase fw-bold text-warning mb-4">Quick Links</h5>
            <p><a href="#" class="text-white text-decoration-none">Privacy Policy</a></p>
            <p><a href="#" class="text-white text-decoration-none">FAQs</a></p>
            <p><a href="#" class="text-white text-decoration-none">Delivery</a></p>
            <p><a href="#" class="text-white text-decoration-none">Season's Gifting</a></p>
            <p><a href="#" class="text-white text-decoration-none">Customer Service</a></p>
          </div>

          <!-- Contact Info -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h5 class="text-uppercase fw-bold text-warning mb-4 ">Contact</h5>
            <p><i class="fas fa-home me-2"></i> Surat, Gujarat</p>
            <p><i class="far fa-envelope me-2"></i> vaghlaparth2005@gmail.com</p>
            <p><i class="fas fa-phone me-2"></i> +91 8735035021</p>
          </div>

        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
          <div class="col-md-6 col-lg-8 mb-3 mb-md-0">
            <p class="mb-0">
              Owned by: <strong class="text-warning">Parth Vaghela</strong>
            </p>
          </div>
          <div class="col-md-6 col-lg-4 text-center text-md-end">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white fs-5"><i class="fab fa-x-twitter"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white fs-5"><i class="fab fa-google-plus-g"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white fs-5"><i class="fab fa-linkedin-in"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <script src="images.js"></script>
    <script src="item.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>