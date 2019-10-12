<template>
    <div>
        <div class="search-wrapper section-padding-100">
            <div class="search-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search-content">
                            <form action="#" method="get">
                                <input type="search" name="search" id="search" placeholder="Type your keyword..."
                                       v-model="filter">
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
                <div class="amado-navbar-brand">
                    <a href="index"><img src="static/img/core-img/logo.png" alt=""></a>
                </div>
                <div class="amado-navbar-toggler">
                    <span></span><span></span><span></span>
                </div>
            </div>

            <div class="products-catagories-area clearfix">
                <div class="amado-pro-catagory clearfix">
                    <div class="single-products-catagory clearfix" :key='idx'
                         v-for="(product,idx) in this.filterProduct">
                        <a href="cart">
                            <img :src="`/static/img/bg-img/${product.img}`" :alt="`/static/img/bg-img/${product.name}`">
                            <div class="hover-content">
                                <div class="line"></div>
                                <p>From ${{product.price}}</p>
                                <h4>{{product.name}}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import {products} from '../../db.json' //const products = db.products
    export default {
        name: 'HomePage',
        data() {
            return {
                countFilter: 0,
                products,
                filter: '',
            }
        },
        computed: {
            filterProduct() {
                let filter = this.filter

                let products = this.products.filter(each => {
                    //const patten = /ea/
                    const patten = new RegExp(this.filter)
                    return patten.test(each.name)
                })

                if (filter.length < this.countFilter && filter.length < 1) {
                    window.location.href = "/#search";
                    location.reload()
                }

                this.countFilter = filter.length;
                return products;
            }
        }
    }
</script>

<style scoped>

</style>
