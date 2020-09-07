<template>
    <div class="cart-table-area section-padding-100">

        <div class="row">
            <div class="welcome-box">
                <h5>Welcome : {{user.email}}</h5>
                <a href="#" @click="logout">
                    <button class="logout-button">logout</button>
                </a>
            </div>

            <div class="col-12 col-lg-10">

                <div class="cart-title mt-50">
                    <h2>Manage Products</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table_admin">
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
                        <tr v-for="(product,idx) in this.products" v-if="product.show">
                            <td class="cart_product_img">
                                <a href="#">
                                    <img :src="`${imgPart+'/'+product.id_product}.jpg`" alt="Product"></a>
                                <input class="img"
                                       type="file" accept="image/*" @change="uploadImage($event,idx)"
                                       :id="`file-input-id-${idx}`">
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
                                        <input type="number" class="form-control" min="1" max="30000" name="quantity"
                                               :value="product.stock">
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
                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Product Name"
                                           v-model="name" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" name="price" placeholder="price"
                                           v-model="price">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" name="quantity" placeholder="quantity"
                                           v-model="stock">
                                </div>
                                <div class="col-12 mb-3">
                                    <img :src="newImg" v-if="newImg">
                                    <input class="form-control" type="file" accept="image/*" @change="onImageChange"
                                           id="file-input">
                                </div>
                            </div>
                            <button type="submit" class="btn amado-btn w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="cart-table-area" v-if="showReport">
                <div class="cart-summary">
                    <h4>Order Report</h4>

                    <div class="ped10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="max10" scope="col">#</th>
                                <th class="max10" scope="col">Qty</th>
                                <th scope="col">Product</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Email</th>
                                <th scope="col">Order Date</th>
                            </tr>
                            <tr v-for="(row,idx) in this.report">
                                <th class="max10" scope="col" style="width: 20px;">{{idx+1}}</th>
                                <th class="max10" scope="col">{{row.qty}}</th>
                                <th scope="col">{{row.name}}</th>
                                <th scope="col">{{row.total}}</th>
                                <th scope="col">{{row.email}}</th>
                                <th scope="col">{{row.date}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import Pusher from 'pusher-js';
    import VueCookies from 'vue-cookies'
    import Swal from 'sweetalert2'

    export default {
        name: 'Admin',
        data() {
            return {
                apiPart: this.$root.$data.apiPart,
                imgPart: this.$root.$data.imgPart,
                pusherKey: this.$root.$data.pusherKey,
                products: [],
                productsAll: [],
                actions: [
                    {'value': false, 'text': 'Hide'},
                    {'value': true, 'text': 'Show'},
                    {'value': null, 'text': 'Remove'},
                ],
                showReport: true,
                report: [],
                user: {},
                name: '',
                price: null,
                stock: null,
                image: '',
                newImg: null,
            }
        },
        mounted() {
            axios.defaults.headers.common['Authorization'] = VueCookies.get('Authorization');
            this.getProduct();
            this.getProfile();
            this.getOrderReport();
            this.loadPusher()
        },
        methods: {
            async logout() {
                try {
                    let response = await axios.post(`${this.apiPart}/logout`);
                    if (response.data.success && response.data.success == true) {
                        Swal.fire({
                            type: 'success',
                            title: 'logout success',
                        });
                        $cookies.remove('Authorization');

                        this.$router.push('login');
                    }
                } catch ({message}) {
                    Swal.fire({
                        type: 'warning',
                        title: 'logout fail',
                    })
                }
            },
            loadPusher() {
                let $this = this;
                this.pusher = new Pusher($this.pusherKey, {
                    cluster: 'ap1',
                    forceTLS: true
                });

                let channel = this.pusher.subscribe('update-product-channel');
                channel.bind('update-product-event', function (data) {
                    $this.getOrderReport();
                    $this.getProduct();
                });
            },
            async getProfile() {
                try {
                    let response = await axios.get(`${this.apiPart}/user/profile`);
                    this.user = response.data.user;
                } catch ({message}) {
                    this.$router.push('login')
                }
            },
            async getOrderReport() {
                try {
                    //const response = await axios.get(`${this.apiPart}/order/report`, this.headers)
                    let response = await axios.get(`${this.apiPart}/order/report`);
                    this.report = response.data.report;
                } catch ({message}) {
                    this.showReport = false;
                }
            },
            async getProduct() {
                try {
                    const res = await axios.get(
                        `${this.apiPart}/product/all`
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
            },
            onImageChange(e) {
                this.image = e.target.files[0];
            },
            async formSubmit(e) {
                e.preventDefault();
                let formData = new FormData();

                formData.append('image', this.image);
                formData.append('name', this.name);
                formData.append('price', parseInt(this.price));
                formData.append('stock', parseInt(this.stock));

                try {
                    let response = await axios.post(`${this.apiPart}/product/add`, formData, this.headers)
                    this.newImg = response.data.part;
                    this.getProduct();
                } catch (e) {

                }
            }
        }
    }
</script>