<template>
    <div class="container">

        <div class="row">
            <div class="py-2">
                <p class="h2 mt-0">Lista produktów</p>
            </div>
            <search-bar></search-bar>
        </div>

        <div class="row">
            <category-list></category-list>

            <div class="col-md-12 col-lg-10">
                <div class="grid pb-3" style="--bs-columns: 2;">
                    <the-product v-for="product in products" :key="product.id" :product="product"></the-product>
                </div>

                <nav aria-label="Page navigation example" v-if="products.length > 0">
                    <ul class="pagination justify-content-center">

                        <li class="page-item" v-for="(link, index) in pagination.links" :key="index">
                            <a class="page-link" :class="{'active': link.active}" @click="getPage(link.url)" v-html="link.label"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import CategoryList from "./Products/CategoryList";
import SearchBar from "./Products/SearchBar";
import TheProduct from "./Products/TheProduct";
import axios from 'axios';

export default {
    name: "ProductList",
    components: {
        CategoryList,
        SearchBar,
        TheProduct
    },
    data() {
        return {
            products: [],

            page: 1,
            perPage: 1,
            pagination: null,
        }
    },
    mounted() {
        this.getProducts()
    },
    methods: {
        getCategories() {},
        getProducts() {
            const url = `/api/products?per_page=6&page=${this.page}`;
            axios.get(url)
                .then(response => {
                    console.log(response.data);
                    this.products = response.data.data;
                    this.pagination = response.data.meta;
                })
                .catch(error => error)
        },
        getPage(url) {
            console.log(url)
        }
    }
}
</script>

<style scoped>

</style>
