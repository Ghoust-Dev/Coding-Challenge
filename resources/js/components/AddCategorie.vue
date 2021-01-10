<template>
    <div>
        <div class="wrap_content">
            <div class="alert alert-success" v-if="success" >
                {{msg}}
            </div>
            <div class="alert alert-warning" v-if="err" >
                <li v-for="(msgList, index) in msgErr" :key="index">
                    {{msgList}}
                </li>            
            </div>
            <div class="wrapper-items">
                <div class="add_categorie">
                    <div class="form-group row">
                        <label for="categorie" class="col-sm-3 col-form-label">Categorie Name</label>
                        <div class="col-sm-6">
                            <input type="text" id="categorie" name="categorie" class="form-control" v-model="categorie">
                        </div>
                    </div>
                    <div class="btn-submit">
                        <button class="btn btn-primary" type="submit" @click="addCategorie">Add Categorie</button>
                    </div>
                    
                </div>
                <div class="add_subCategorie">
                    <div class="form-group row">
                        <label for="sub-categorie" class="col-sm-3 col-form-label">Sub Categorie</label>
                        <div class="col-sm-5">
                            <input type="text" id="sub-categorie" name="sub_categorie" class="form-control" v-model="sub_categorie">
                        </div>
                        <select name="cat_parent_id" @change="onChange($event)" class="form-control col-md-3">
                            <option selected>Select Parent Categorie</option>
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
                    <div class="btn-submit">
                        <button class="btn btn-primary" type="button" @click="addSubCategorie">Add Sub Categorie</button>
                    </div>
                    
            </div>
            </div>
        </div>
    </div>
</template>

<script>

import router from '../routes'
import Navbar from "../components/Navbar"

export default {
    components: {
        Navbar
    },
    data() {
        return {
            categorie : '',
            allCategories : {},
            sub_categorie : '',
            cat_parent_id : '',
            publicPath: window.location.origin,
            success: false,
            err: false,
            msg: '',
            msgErr:{},
        }
    },
    mounted() {
        getCat: {
            axios.get(`/api/showCategories`).then(res => {
                if(res.status){
                    this.allCategories = res.data.categories;
                    
                }
            })
        }
    },
    methods: {
        addCategorie(){

            let formData = new FormData();
            formData.append('categorie', this.categorie);

            axios.post(`${this.publicPath}/api/addCategorie`,formData).then(res => {
                if(res.data.status){
                    this.success = true;
                    this.err = false;
                    this.msg = res.data.message;
                }else {
                    this.err = true;
                    this.success = false;
                    Object.values(res.data.error).forEach(val =>{
                        this.msgErr = val; 
                    });                         
                }
            })

            
        },
        addSubCategorie(){
            let formData = new FormData();
            
            formData.append('sub_categorie', this.sub_categorie);
            formData.append('cat_parent_id', this.cat_parent_id);

            axios.post(`${this.publicPath}/api/addSubCategorie`,formData).then(res => {
                if(res.data.status){
                    this.success = true;
                    this.err = false;
                    this.msg = res.data.message;
                }else{
                    this.err = true;
                    this.success = false;
                    Object.values(res.data.error).forEach(val =>{                        
                        this.msgErr = val; 
                    });                         
                }
            })
        },
        onChange(event){
            this.cat_parent_id = event.target.value;
        }
        
    },
}
</script>

<style>

.wrap_content {
    display: grid;
    justify-content: center;
}

.wrapper-items {
    margin-top: 2em;
    background: #fff;
    padding: 24px;
    max-width: fit-content;
    border-radius: 10px;
}

.wrapper-items .form-group {
    justify-content: flex-start;
}

.wrapper-items .btn-submit {
    justify-content: center;
    display: flex;
}

.wrapper-items .add_categorie,
.wrapper-items .add_subCategorie {
    margin: 10px 5px 24px;
    border: 1px;
    border-radius: 5px;
    padding: 10px 5px 20px;
    border-style: solid;
    border-color: #1212;
}
</style>