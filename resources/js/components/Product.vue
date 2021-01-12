<template>
    <div class="container">        
        <div class="Product-details row">
            <div class="display-product" v-for="value in products" :key="value.id">
                <div class="card box-product"  >
                    <div class="card-head">
                        <div class="image-product">
                            <router-link :to="{name:'product', params:{ id:value.id}}">
                                <img :src="value.image" alt="">
                            </router-link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="name-product">
                            <router-link :to="{name:'product', params:{ id:value.id}}" v-model="id">{{value.name}}</router-link>                    
                        </div>
                        <div class="price-product">Price : {{value.price}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'products'
    ],
    data() {
        return {
            id:''
        }
    }
}
</script>

<style>
.Product-details {
    margin-top: 24px;   
    display: flex;
}

.Product-details .image-product img{
    width: 200px;
    height: 200px;
}

.display-product {
    height: fit-content;
    margin-bottom: 20px;
}

.box-product { 
    margin-right: 2em;
    display: grid;
    height: 280px;
    width: 200px;
    overflow: hidden;
    border-radius: 10px;
}

.box-product .card-body{
    padding: 0.5em;
}

.box-product .name-product {
    font-weight: 600;
    margin-bottom: 10px;
}


</style>