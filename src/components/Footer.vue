<template>
    <div style=" clear: both">
        <footer class="footer_area">

            <div class="container">
                <div class="row align-items-center">
                    <!-- Single Widget Area -->
                    <div class="col-12 col-lg-4">
                        <div class="single_widget_area">
                            <!-- Logo -->
                            <div class="footer-logo mr-50">
                                <a href="index"><img src="static/img/core-img/logo2.png" alt=""></a>
                            </div>
                            <!-- Copywrite Text -->
                            <p class="copywrite">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; All rights reserved | This template is made with <i
                                    class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                        target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="col-12 col-lg-8">
                        <div class="single_widget_area">
                            <!-- Footer Menu -->
                            <div class="footer_menu">
                                <nav class="navbar navbar-expand-lg justify-content-end">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#footerNavContent" aria-controls="footerNavContent"
                                            aria-expanded="false" aria-label="Toggle navigation"><i
                                            class="fa fa-bars"></i></button>
                                    <div class="collapse navbar-collapse" id="footerNavContent">
                                        <ul class="navbar-nav ml-auto">
                                            <li v-for="(menu,idx) in this.menus" :class="`nav-item ${menu.active}`">
                                                <a class="nav-link" :href="menu.part">{{menu.name}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: 'Footer',
        mounted() {
            let idx = this.menus.findIndex(x => x.part === this.$route.path)
            this.menus[idx].active = 'active';
        },
        data() {
            return {
                menus: [
                    {"name": "Home", "part": "/", "active": ""},
                    {"name": "Cart", "part": "/cart", "active": ""},
                    {"name": "Checkout", "part": "/checkout", "active": ""},
                    {"name": "admin", "part": "/admin", "active": ""}
                ]
            }
        }
    }
</script>
