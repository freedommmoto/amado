<template>
    <div class="cart-table-area section-padding-100">

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Shopping Cart</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(product,idx) in this.customerProducts">
                            <template v-if="product">
                                <td class="cart_product_img">
                                    <a href="#"><img :src="`/img/${product.id_product}.jpg`"
                                                     alt="Product"></a>
                                </td>
                                <td class="cart_product_desc">
                                    <h5>{{product.name}}</h5>
                                </td>
                                <td class="price">
                                    <span>${{product.price}}</span>
                                </td>
                                <td class="qty">
                                    <div class="qty-btn d-flex">
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span @click="updateCustomerProducts(product,'minus')" class="qty-minus">
                                                <i class="fa fa-minus"
                                                   aria-hidden="true"></i>
                                            </span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="300"
                                                   name="quantity" :value="product.qty"
                                            >
                                            <span @click="updateCustomerProducts(product,'plus')" class="qty-plus">
                                                <i class="fa fa-plus"
                                                   aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </template>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>${{totalPrice}}</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>${{totalPrice}}</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="/checkout" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'Cart',
        data() {
            return {
                apiPart: this.$root.$data.apiPart,
                allProducts: [],
                customerProducts: [],
                totalPrice: 0,
            }
        },
        methods: {
            async getProductList() {
                try {
                    const res = await axios.get(
                        `${this.apiPart}/product/all`
                    )
                    this.allProducts = res.data.products

                } catch ({message}) {
                    console.log(message)
                }
            },
            updateCustomerProducts(product, action) {
                if (product.id_product) {
                    let index = this.customerProducts.findIndex(inArrayProduct => inArrayProduct.id_product === product.id_product)
                    if (index > -1) {
                        let customerProducts = this.customerProducts;
                        if (action === 'plus') {
                            customerProducts[index].qty += 1;
                        } else {
                            customerProducts[index].qty -= 1;
                            if (customerProducts[index].qty < 1) {
                                customerProducts.splice(index, 1);
                                this.$root.$data.numOrder--;
                            }
                        }

                        localStorage.setItem("customerProducts", JSON.stringify(customerProducts));
                        this.customerProducts = JSON.parse(localStorage.getItem("customerProducts"));
                        this.totalPrice = this.sumPrice(this.customerProducts, 'price');

                    }
                }
            },
            sumPrice(items, prop) {
                return items.reduce(function (a, b) {
                    return a + b[prop] * b.qty;
                }, 0);
            }
        },
        mounted() {
            this.getProductList()
            this.customerProducts = JSON.parse(localStorage.getItem("customerProducts"));
            this.$root.$data.numOrder = (this.customerProducts) ? this.customerProducts.length : 0
            this.totalPrice = this.sumPrice(this.customerProducts, 'price');
        },
    }
</script>