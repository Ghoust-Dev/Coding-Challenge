<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{name:'home'}" class="nav-link">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'addProduct'}" class="nav-link">Add Product</router-link> 
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'addCategorie'}" class="nav-link">Add Categorie</router-link>
                </li>
            </ul>
        </div>
    </nav>
    
</template>

<script>
export default {
    
}
</script>

<style>

a.active {
   background-color: #c5c3c6;
   border-radius: 5px;
   color: #46494c;
   cursor: pointer;
   font-weight: 600;

}


</style>