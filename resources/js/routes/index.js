import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../home';
import AddProduct from '../components/AddProduct';
import ShowProduct from '../components/ShowProduct';
import EditProduct from '../components/EditProduct';
import AddCategorie from '../components/AddCategorie';

Vue.use(VueRouter)

const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/addProduct',
            name: 'addProduct',
            component: AddProduct
        },
        {
            path: '/product/:id',
            name: 'product',
            component: ShowProduct
        },
        {
            path: '/product/edit/:id',
            name: 'edit-product',
            component: EditProduct
        },
        {
            path: '/categorie/',
            name: 'addCategorie',
            component: AddCategorie
        }
    ],
    linkExactActiveClass: 'active'
});

export default router;