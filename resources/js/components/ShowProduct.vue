<template>
    <div class="container show-product">
        <div class="card">
            <div class="actions">
                <router-link :to="{name:'edit-product', params:{ id:id}}">
                    <span class="btn btn-warning">Edit</span>
                </router-link>
                <span class="btn btn-danger" @click="Delete">
                    Delete
                </span>
            </div>
            <div class="categories-list">
                <span><strong>{{Categorie}}</strong> > </span>
                <span v-if="SubCatExist">{{subCategorie}} > </span>
            </div>
            <div class="head-product">
                <div class="">
                    <img :src="publicPath+'/'+product.image" alt="">
                </div>
                <div class="details-product">
                    <div class="name-product"><strong>{{product.name}}</strong></div>
                    <div class="price-product">Price : {{product.price}}</div>
                </div>
            </div>
            
            <div class="description-product">
                <strong>Description :</strong> 
                <p>{{product.description}}</p> 
            </div>
        </div>
        
    </div>
</template>

<script>
import router from '../routes';

export default {
    data() {
        return {
            id: this.$route.params.id,
            product: {},
            publicPath: window.location.origin,
            Categorie:'',
            subCategorie:'',
            SubCatExist : false
        }
    },
    mounted() {
        getP:{
            axios.get(`${this.publicPath}/api/showProduct/${this.id}`).then(res => {
                Object.values(res.data).forEach(product =>{
                    this.product = product;
                })
                this.getCat();
            })
        }        
        
    },
    methods:{
        Delete(){
            axios.get(`${this.publicPath}/api/deleteProduct/${this.id}`).then(res => {
                 this.$router.push('/');
            })
        },

        getCat() {
            axios.get(`/api/showCategorie/${this.product.categorie_id}`).then(res => {
                Object.values(res.data).forEach(value =>{
                    this.Categorie = value.name;
                })                  
                this.getSubCat();
            })
        },

        getSubCat() {
            if(this.product.sub_categorie_id != null){
                axios.get(`/api/showCategorie/${this.product.sub_categorie_id}`).then(res => {
                    
                    this.SubCatExist = true; 
                    Object.values(res.data).forEach(value =>{ 
                        this.subCategorie = value.name;
                    }) 
                                
                })
            }
            
        }
    }
}
</script>

<style>

.show-product {
    margin-top: 1em;
    padding: 2em;
    height: 100vh;
    display: flex;
    background: #fff;
    justify-content: center;
}

.show-product .card {
    border-radius: 18px;
    display: grid;
    width: -webkit-fill-available;
    height: min-content;
    padding: 10px;
}

.show-product .actions {
    margin-bottom: 10px;
}

.show-product .actions .btn{
    color: #fff;
}

.head-product {
    height: max-content;
    display: inline-flex;
    align-items: flex-start;
    margin: 10px 0px;
}

.head-product img{
    width: 500px;
    height: 500px;
}

.head-product .name-product{
    font-size: 2em;
}

.head-product .details-product {
    display: grid;
    margin-left: 1em;
}

.description-product {
    margin-top: inherit;
}

</style>