<template>
    <div class="wrapper">
        <v-head></v-head>
        <v-sidebar></v-sidebar>
        <v-content></v-content>
        <v-footer></v-footer>
    </div>
</template>

<script>
    import vHead from './Header.vue'
    import vSidebar from './Sidebar.vue'
    import vContent from './Content.vue'
    import vFooter from './Footer.vue'

    export default {
        components: {
            vHead,
            vSidebar,
            vContent,
            vFooter
        }
    }

</script>