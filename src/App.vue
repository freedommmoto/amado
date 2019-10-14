<template>
    <div id="app" class="main-content-wrapper">
        <navbar :isAuth="isAuth"/>
        <router-view/>
        <footerWeb/>
    </div>
</template>

<script>

    import NavBar from './components/NavBar.vue'
    import Footer from './components/Footer.vue'

    export default {
        name: 'App',
        components: {
            navbar: NavBar,
            footerWeb: Footer
        },
        data() {
            return {
                isAuth: false
            }
        },
        beforeDestroy() {

        },
        mounted() {

        },
        methods: {}

    }

</script>

<style>
</style>
