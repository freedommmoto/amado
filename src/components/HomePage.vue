<template>
  <div >

    <div class="search-wrapper section-padding-100">
      <div class="search-close">
        <i class="fa fa-close" aria-hidden="true"></i>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="search-content">
              <form action="#" method="get">
                <input type="search" name="search" id="search" placeholder="Type your keyword...">
                <button type="submit"><img src="static/img/core-img/search.png" alt=""></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-content-wrapper d-flex clearfix">

      <!-- Mobile Nav (max width 767px)-->
      <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
          <a href="index"><img src="static/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
          <span></span><span></span><span></span>
        </div>
      </div>

      <!-- Product Catagories Area Start -->
      <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/1.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $180</p>
                <h4>Modern Chair</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/2.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $180</p>
                <h4>Minimalistic Plant Pot</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/3.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $180</p>
                <h4>Modern Chair</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/4.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $180</p>
                <h4>Night Stand</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/5.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $18</p>
                <h4>Plant Pot</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/6.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $320</p>
                <h4>Small Table</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/7.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $318</p>
                <h4>Metallic Chair</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/8.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $318</p>
                <h4>Modern Rocking Chair</h4>
              </div>
            </a>
          </div>

          <!-- Single Catagory -->
          <div class="single-products-catagory clearfix">
            <a href="shop">
              <img src="static/img/bg-img/9.jpg" alt="">
              <!-- Hover Content -->
              <div class="hover-content">
                <div class="line"></div>
                <p>From $318</p>
                <h4>Home Deco</h4>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- Product Catagories Area End -->
    </div>

  </div>
</template>

<script>
  export default {
    name: 'HomePage',
    data () {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    }
  }
</script>

<style scoped>

</style>
