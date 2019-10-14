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
                                <input type="password" class="form-control" v-model="passWord" name="name"
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

    export default {
        name: 'Admin',
        data() {
            return {
                userName: '',
                passWord: '',
                apiPart: this.$root.$data.apiPart,
            }
        },
        mounted() {

        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                this.checkLoginWithApi(this);
            },
            async checkLoginWithApi($this) {

                const config = {headers: {'content-type': 'multipart/form-data'}}
                let response = null

                $this.formData = new FormData();
                $this.formData.append('userName', $this.userName);
                $this.formData.append('passWord', $this.passWord);

                response = await axios.post(`${this.apiPart}/user/login`, $this.formData, config)
                if (response.data.success) {
                    sessionStorage.setItem("userData", JSON.stringify(response.data.userData));
                    this.$router.push('admin')
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: 'username or password is incorrect',
                    })
                }
            },
        }
    }
</script>
