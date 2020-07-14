<template>
    <div class="flex flex-col fle-1 h-screen overflow-hidden">
        <Nav></Nav>
        <router-view></router-view>
    </div>
</template>

<script>
    import Nav from "./Nav";
    export default {
        name: "App",
        components: {
            Nav,
        }
    }
</script>

<style scoped>

</style>
