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
                                <input type="email" required class="form-control" v-model="email" placeholder="email"
                                       value="">
                            </div>
                            <div class="col-12 mb-3">
                                <input type="password" required class="form-control" v-model="password"
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
    import Swal from 'sweetalert2'
    import store from '@/store'
    import VueCookies from 'vue-cookies'

    export default {
        name: 'Admin',
        data() {
            return {
                email: '',
                password: '',
                apiPart: this.$root.$data.apiPart,
            }
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                this.checkLoginWithApi(this);
            },
            async checkLoginWithApi($this) {

                const config = {headers: {'content-type': 'multipart/form-data'}}

                $this.formData = new FormData();
                $this.formData.append('email', $this.email);
                $this.formData.append('password', $this.password);

                try {
                    const response = await axios.post(`${this.apiPart}/login`, $this.formData, config);
                    if (response.data.token) {
                        //axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                        //localStorage.setItem('token', response.data.token);
                        VueCookies.set('Authorization' , 'Bearer '+response.data.token, "1h")

                        store.commit('LOGIN_USER');
                        this.$router.push('admin');
                    }
                } catch (e) {
                    console.log(e);
                    Swal.fire({
                        type: 'warning',
                        title: 'username or password is incorrect',
                    })
                }
            },
        }
    }
</script>
