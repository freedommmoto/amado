<template>
  <div style="float: left">
    <!-- Header Area Start -->
    <header class="header-area clearfix">
      <!-- Close Icon -->
      <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
      </div>
      <!-- Logo -->
      <div class="logo">
        <a href="index"><img src="static/img/core-img/logo.png" alt=""></a>
      </div>
      <!-- Amado Nav -->
      <!--            <nav class="amado-nav">-->
      <!--                <ul>-->
      <!--                    <li class="active"><a href="index">Home</a></li>-->
      <!--                    <li><a href="shop">Shop</a></li>-->
      <!--                    <li><a href="product-details">Product</a></li>-->
      <!--                    <li><a href="cart">Cart</a></li>-->
      <!--                    <li><a href="checkout">Checkout</a></li>-->
      <!--                </ul>-->
      <!--            </nav>-->
      <!-- Button Group -->
      <!--            <div class="amado-btn-group mt-30 mb-100">-->
      <!--                <a href="#" class="btn amado-btn mb-15">%Discount%</a>-->
      <!--                <a href="#" class="btn amado-btn active">New this week</a>-->
      <!--            </div>-->
      <!-- Cart Menu -->
      <div class="cart-fav-search mb-100">
        <a href="/" class="cart-nav"><img src="static/img/core-img/home.png" alt=""> Home </a>
        <a href="/cart" class="cart-nav"><img src="static/img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
        <a href="/checkout" class="fav-nav"><img src="static/img/core-img/favorites.png" alt=""> CheckOut</a>
        <a v-if="isHomePage" href="#" class="search-nav"><img src="static/img/core-img/search.png" alt=""> Search</a>
      </div>
      <!-- Social Button -->
      <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
      </div>
    </header>
    <!-- Header Area End -->
  </div>
</template>

<script>
export default {
  name: 'NavBar',
  data () {
    return {
      isHomePage: this.$route.path === '/'
    }
  },
  mounted() {

  },
}
</script>

<style scoped>

</style>
