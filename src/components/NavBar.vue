<template>
    <div style="float: left">
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index"><img src="static/img/core-img/logo.png" alt=""></a>
            </div>
            <div class="cart-fav-search mb-100">
                <a href="/" class="cart-nav"><img src="static/img/core-img/home.png" alt=""> Home </a>
                <template v-if="!isAdmin">
                    <a href="/cart" class="cart-nav"><img src="static/img/core-img/cart.png" alt=""> Cart <span>({{numOrder}})</span></a>
                    <a href="/checkout" class="fav-nav"><img src="static/img/core-img/favorites.png" alt="">
                        CheckOut</a>
                    <a v-if="isHomePage" href="#" class="search-nav"><img src="static/img/core-img/search.png">
                        Search</a>
                </template>

            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        name: 'NavBar',
        data() {
            return {}
        },
        watch: {
            numOrder() {
                console.log('order change');
            },
        },
        computed: {
            numOrder() {
                return this.$root.$data.numOrder
            },
            isHomePage() {
                return (this.$route.path === '/')
            },
            isAdmin() {
                return (this.$route.path === '/admin')
            }
        },
    }
</script>

<style scoped>
    .nav {
        float: left;
    }
</style>
