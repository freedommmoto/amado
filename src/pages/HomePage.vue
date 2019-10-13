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
                <div class="amado-pro-catagory clearfix ">
                    <div class="single-products-catagory clearfix" :key='idx'
                         v-for="(product,idx) in this.filterProduct"
                         v-bind:style="[product.stock > 0 ? {} : {opacity:0.4}]"
                    >
                        <a href="#" @click="activeProduct(product)">
                            <img :src="`/static/img/bg-img/${product.img}`" :alt="`/static/img/bg-img/${product.name}`">
                            <div class="hover-content">
                                <div class="line"></div>
                                <p>From ${{product.price}}</p>
                                <h4 v-if="product.stock > 0">{{product.name}}</h4>
                                <h4 v-else>{{product.name}} - Sold out</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    //import {products} from '../../db.json' //const products = db.products
    import Swal from 'sweetalert2'
    import axios from 'axios'
    import Masonry from 'masonry-layout'

    export default {
        name: 'HomePage',
        data() {
            return {
                apiPart: this.$root.$data.apiPart,
                countFilter: 0,
                products: [],
                filter: '',
                get customerProducts() {
                    return JSON.parse(localStorage.getItem("customerProducts"));
                },
                set customerProducts(value) {
                    if (value.id) {
                        if (!this.customerProducts) {
                            localStorage.setItem("customerProducts", JSON.stringify([value]));
                        }

                        let index = this.customerProducts.findIndex(x => x.id === value.id)
                        if (index > -1) {
                            let customerProducts = this.customerProducts;
                            customerProducts[index].stock += 1;
                            localStorage.setItem("customerProducts", JSON.stringify(customerProducts));
                        } else {
                            localStorage.setItem("customerProducts", JSON.stringify([...this.customerProducts, value]));
                        }
                    }
                }
            }
        },
        mounted() {
            this.getProductList()
            this.$root.$data.numOrder = (this.customerProducts) ? this.customerProducts.length : 0
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
        },
        created() {
            document.addEventListener("resize", this.myEventHandler);
        },
        destroyed() {
            document.removeEventListener("resize", this.myEventHandler);
        },
        methods: {
            renderMasonry() {
                const grid = document.querySelector('.amado-pro-catagory')
                const singleProCata = '.single-products-catagory'
                const msnry = new Masonry(grid, {
                    itemSelector: singleProCata,
                    percentPosition: true,
                    masonry: {columnWidth: singleProCata},
                })

                msnry.once('layoutComplete', () => {
                    grid.classList.add('load')
                })

                msnry.layout()
            },
            async getProductList() {
                try {
                    const res = await axios.get(
                        `${this.apiPart}/product`
                    )
                    this.products = res.data.products
                    let $this = this
                    setTimeout(function () {
                        $this.renderMasonry();
                    }, 100);

                } catch ({message}) {
                    console.log(message)
                }
            },
            activeProduct(product) {
                if (product.stock > 0) {
                    Swal.fire({
                        title: `Are you want to order ${product.name}?`,
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            this.customerProducts = product
                            this.$root.$data.numOrder = this.customerProducts.length

                            Swal.fire({
                                type: 'success',
                                title: 'already added you product!',
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: 'This product is Sold out',
                    })
                }
            }
        }
    }
</script>

<style scoped>
</style>
