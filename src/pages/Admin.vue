<template>
    <div class="cart-table-area section-padding-100">

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="cart-title mt-50">
                    <h2>Manage Products</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr v-for="(product,idx) in this.products">
                            <td class="cart_product_img">
                                <a href="#"><img :src="`static/img/bg-img/${product.img}`" alt="Product"></a>
                            </td>
                            <td class="cart_product_desc">
                                <span>
                                <input type="text" class="form-control input-name" name="quantity"
                                       :value="product.name">
                                </span>
                            </td>
                            <td class="price">
                                <span>
                                  <input type="number" class="form-control" min="1" max="30000" name="quantity"
                                         :value="product.price">
                                </span>
                            </td>
                            <td class="qty">
                                <div class="qty-btn d-flex">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus"
                                              onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300"
                                               name="quantity" :value="product.stock">
                                        <span class="qty-plus"
                                              onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td class="price">
                                <span>
                                   <select v-model="product.show" class="form-control">
                                        <option v-for="action in actions" :value="action.value">{{action.text}}</option>
                                   </select>
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn amado-btn small-btn">SAVE</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="cart-table-area" v-if="products.length < 3 && productsAll.length > 2">
                <a href="#" class="btn w-100" @click="showAll()">
                    <h4>Show All</h4>
                </a>
            </div>

            <div class="cart-table-area">
                <div class="cart-summary">
                    <h4>Add New Products</h4>

                    <div style="padding: 10px;">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="price" placeholder="price" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" id="quantity" min="0"
                                           placeholder="quantity" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10"
                                              placeholder="Leave a comment about your order"></textarea>
                                </div>

                            </div>
                        </form>
                        <a href="/checkout" class="btn amado-btn w-100">SAVE</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'Admin',
        data() {
            return {
                products: [],
                productsAll: [],
                actions: [
                    {'value': 0, 'text': 'Hide'},
                    {'value': 1, 'text': 'Show'},
                    {'value': -1, 'text': 'Remove'},
                ],
            }
        },
        mounted() {
            this.getProduct()
        },
        methods: {
            async getProduct() {
                try {
                    const res = await axios.get(
                        `http://api.amado.com/product`
                    )
                    if (res.data.products[0] && res.data.products[1]) {
                        this.products = [...this.products, res.data.products[0], res.data.products[1]]
                    } else {
                        this.products = res.data.products
                    }
                    this.productsAll = res.data.products

                } catch ({message}) {
                    console.log(message)
                }
            },
            showAll() {
                this.products = this.productsAll
            }
        }
    }
</script>

<style scoped>

    .input-name {
        width: 130px;
        height: 38px;
        overflow: scroll
    }

    .main-content-wrapper .cart-table-area .cart-summary {
        margin-top: 10px;
    }

    .cart-table-area {
        margin-top: 0px;
        padding: 0px;
    }

    .table {
        overflow: auto !important;
        outline: none;
        width: 80%;
    }

    .amado-btn {
        min-width: 90px;
    }

    th {
        background: #FFFFFF;
    }

    #scrollUp {
        width: 1000px;
        height: 1000px;
    }
</style>
