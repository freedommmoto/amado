<template>
    <div>
        <img src="static/img/product-img/pro-big-2.jpg" class="img_login">
        <div style="clear: both"></div>
        <div class="row login-row">
            <div class="cart-summary">
                <h4>Login</h4>

                <div style="padding: 10px;">
                    <form @submit="formSubmit" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" v-model="userName" placeholder="User Name"
                                       value="">
                            </div>
                            <div class="col-12 mb-3">
                                <input type="password" class="form-control" v-model="password" name="name"
                                       placeholder="password" value="">
                            </div>
                        </div>
                        <button type="submit" class="btn amado-btn w-100">Submit</button>
                    </form>
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
                userName: '',
                password: '',
                apiPart: this.$root.$data.apiPart,
            }
        },
        mounted() {

        },
        methods: {}
    }
</script>
