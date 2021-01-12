<template>
    <div class="container addProduct">
        <div class="alert alert-danger" v-if="err" >
            {{msgErr}}           
        </div>
        <form @submit="submitForm" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" id="name" name="name" class="form-control" v-model="product.name">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label ">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" id="description" name="description" class="form-control" rows="5" v-model="product.description"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-2">
                    <input type="text" id="price" name="price" class="form-control" v-model="product.price" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6" style="display: inline-flex;justify-content: space-around;">
                    <label for="cat_parent_id" >Categorie</label>
                    <div class="select-categorie">
                        <select name="cat_parent_id" @change="getCategorieId($event)" class="form-control">
                            <option selected>Select Categorie</option>
                            <optgroup label="-------------------"></optgroup>
                            <option 
                                v-for="(categorie, index) in allCategories" 
                                :key="index"
                                
                                :value="categorie.id"
                            >
                            {{categorie.name}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6" style="display: inline-flex;justify-content: space-around;">
                    <label for="sub_categorie_id" >Sub Categorie</label>
                    <div class="select-sub-categorie">
                        <select name="sub_categorie_id" @change="getSubCategorieId($event)" class="form-control">
                            <option selected>Select Sub Categorie</option>
                            <optgroup label="-------------------"></optgroup>
                            <option 
                                v-for="(subCategorie, index) in allSubCategories" 
                                :key="index"
                                
                                :value="subCategorie.id"
                            >
                            {{subCategorie.name}}
                            </option>
                        </select>
                    </div>
                </div>                
            </div>
            
            <div class="form-group add-image">
                <label for="image">Add Image</label>
                <input type="file" name="image" class="form-control-file col-sm-4" id="image" @change="selectImage">
            </div>
            <div class="btn-submit">
                <input type="submit" class="btn btn-outline-primary" value="Update Product"/>
            </div>
            
        </form>        
    </div>
</template>

<script>
import router from '../routes';

    export default {

        data() {
            return {
                product: {
                    name : '',
                    categorie_id : '',
                    sub_categorie_id : '',
                    description : '',
                    price : '',
                    image : ''
                },
                id: this.$route.params.id,
                publicPath: window.location.origin,
                err:false,
                msgErr:{},
                allCategories : {},
                allSubCategories : {},
            }
        },
        mounted() {
            getP:{
                axios.get(`/api/showProduct/${this.id}`).then(res => {
                    Object.values(res.data).forEach(product =>{
                        this.product = product;
                    })
                    
                })
            }

            getCat: {
                axios.get(`/api/showCategories`).then(res => {
                    this.allCategories = res.data.data;
                })
            }
        },
        computed:{

        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                
                let formData = new FormData();
                formData.append('name', this.product.name);
                formData.append('categorie_id', this.product.categorie_id);
                formData.append('sub_categorie_id', this.product.sub_categorie_id);
                formData.append('description', this.product.description);
                formData.append('price', this.product.price);
                formData.append('image', this.product.image);
                this.id = this.$route.params.id;
                axios.post(`${this.publicPath}/api/updateProduct/${this.id}`,formData)
                    .then(() => {
                        this.$router.push('/');
                    }).catch(err => {
                        this.err = true;
                        this.msgErr = err.response.data.error;       
                    })
            },
            selectImage(e) {
                this.product.image = e.target.files[0];
            },
            getCategorieId(e){
                this.product.categorie_id = e.target.value;
                this.getSubCat();
            },

            getSubCategorieId(e){
                this.product.sub_categorie_id = e.target.value;
            },

            getSubCat() {
                axios.get(`/api/showSubCategories/${this.product.categorie_id}`).then(res => {
                    this.allSubCategories = res.data.subCategories;
                })
            }
        },
    }
</script>
