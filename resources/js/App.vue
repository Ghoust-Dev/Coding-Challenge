<template>
    <div class="app">
        <Navbar/>
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from "./components/Navbar"

export default {
   components: {
        Navbar
    }, 
}
</script>

<style>

.app {
    min-height: 100vh;
    background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
}

</style>