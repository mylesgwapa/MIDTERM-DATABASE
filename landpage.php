<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="landpage.css" />
    <title>Landing page</title>
  </head>
  <body>
   
    <nav>
      <div class="nav__header">
        <div class="logo nav__logo">
          <a href="#">
            <img src="LOGS.webp" alt="MRP Sari Store Logo" class="logo__image" />
            MRP<span>Store</span>
          </a>
        </div>
      </div>
      
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="admin.php">Admin</a></li>
      </ul>
      <div class="nav__btn">
        <button class="btn"><i class="ri-shopping-bag-fill"></i></button>
      </div>
    </nav>
    <header class="section__container header__container" id="home">
      <div class="header__image">
        <img src="try.webp" alt="header" />
      </div>
      <div class="header__content">
        <h1>Welcome to MRP Sari-Sari Store</h1>
        <p class="section__description">
            Find everything you need and enjoy the local flavors that make our store special.
        </p>
        <a href="product.php" target="_blank">
    <button class="btn">Visit Us Now</button>
</a>
    </div>    
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
