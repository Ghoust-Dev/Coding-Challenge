<template>
    <div class="wrapper">
        <div class="product-list container">
            <div class="brows-products row">
                <span class="col-sm-1">Sort by :</span>
                <select name="filter_name" @change="filterProducts($event)" class="form-control col-sm-1">
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                    <option value="categorie_id">Categorie</option>
                </select>
            </div>
            <Product v-bind:products="products"/>
        </div>
        <router-view></router-view>
    </div>
</template>>

<script>
import Product from "./components/Product"

export default {
    components: {
        Product,
    },
    data() {
        return {
            products:{},
            publicPath: window.location.origin,
            filterName:'name',
        }
    },
    mounted(){
        displayPr:{
            this.browsProducts();
        }
    },
    methods: {
        browsProducts(){
            axios.get(`${this.publicPath}/api/showProducts/${this.filterName}`).then(res => {
                if(res.status){
                    this.products = res.data.products;
                }else {
                    console.log('Error when retreive data')
                }
            })
        },
        filterProducts(e){
            this.filterName = e.target.value;
            this.browsProducts();
        }
    },
}
</script>>

<style>

.brows-products {
    padding-top: 24px;   
    display: flex;
    align-items: center;
}

</style>>