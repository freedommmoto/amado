<template>
    <div class="cart-table-area section-padding-100">
        <form @submit="formSubmit">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" v-model="firstName" value=""
                                           placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" v-model="lastName" value=""
                                           placeholder="Last Name" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" v-model="email" placeholder="Email"
                                           required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" v-model="streetAddress"
                                           placeholder="Address" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" v-model="zipCode" placeholder="Zip Code"
                                           value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" v-model="phoneNumber" min="0"
                                           placeholder="Phone No" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea class="form-control w-100" name="comment" v-model="comment" cols="30"
                                              rows="10"
                                              placeholder="Leave a comment about your order"></textarea>
                                </div>

                                <!--                                <div class="col-12">-->
                                <!--                                    <div class="custom-control custom-checkbox d-block">-->
                                <!--                                        <input type="checkbox" class="custom-control-input" id="customCheck3"-->
                                <!--                                               name="ship">-->
                                <!--                                        <label class="custom-control-label" for="customCheck3">Ship to a different-->
                                <!--                                            address</label>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>

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

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15"
                                                                                                 src="static/img/core-img/paypal.png"
                                                                                                 alt=""></label>
                                </div>
                            </div>

                            <div class="cart-btn mt-100">
                                <button type="submit" class="btn amado-btn w-100">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    import Swal from 'sweetalert2'

    export default {
        name: 'CheckOut',
        data() {
            return {
                apiPart: this.$root.$data.apiPart,
                totalPrice: 0,
                firstName: '',
                lastName: '',
                email: '',
                streetAddress: '',
                zipCode: '',
                phoneNumber: '',
                comment: '',
                customerProducts: [],
            }
        }, mounted() {
            this.customerProducts = JSON.parse(localStorage.getItem("customerProducts"));
        }, methods: {
            async formSubmit(e) {
                e.preventDefault();

                const config = {headers: {'content-type': 'multipart/form-data'}}
                let formData = new FormData();
                formData.append('firstName', this.firstName);
                formData.append('lastName', this.lastName);
                formData.append('product', JSON.stringify(this.customerProducts));
                formData.append('email', this.email);
                formData.append('streetAddress', this.streetAddress);
                formData.append('zipCode', this.zipCode);
                formData.append('phoneNumber', this.phoneNumber);
                formData.append('comment', this.comment);

                let response = null
                response = await axios.post(`${this.apiPart}/order/new`, formData, config)
                if (response.data.success) {
                    Swal.fire({
                        type: 'success',
                        title: 'you order have been send to us',
                    })
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: response.data.error,
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
