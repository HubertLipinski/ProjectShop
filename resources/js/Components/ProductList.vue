<template>
    <div class="container">
        <div class="row">
            <div class="d-flex py-2">
                <div class="w-50">
                    <p class="h2 mt-0">Lista produktów</p>
                </div>
                <div class="w-50 text-end" v-if="hasActiveFilters">
                    <button type="button" class="btn btn-outline-secondary" @click="resetFilters">Resetuj filtry</button>
                </div>
            </div>
            <search-bar @search="searchProducts" ref="searchBar"></search-bar>
        </div>

        <div class="row">
            <category-list @categoriesUpdated="fetchCategories" ref="categoryList"></category-list>

            <div class="col-md-12 col-lg-10" v-loading="loading">
                <div class="grid pb-3" style="--bs-columns: 2;">
                    <the-product v-for="product in products" :key="product.id" :product="product"></the-product>
                </div>

                <div class="pagination justify-content-center py-3" v-if="paginationData && paginationData.total > 0">
                    <el-pagination
                        @current-change="getPage"
                        layout="prev, pager, next"
                        background
                        :page-size="perPage"
                        :current-page="page"
                        :total="paginationData.total">
                    </el-pagination>
                </div>
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
        TheProduct,
    },
    data() {
        return {
            products: [],
            categories: [],
            search: null,
            loading: true,

            page: 1,
            perPage: 6,
            paginationData: null,
        }
    },
    async mounted() {
        this.getProducts()
    },
    computed: {
        hasActiveFilters() {
            return this.categories.length || this.search;
        }
    },
    methods: {
        getProducts() {
            this.loading = true;
            let url = `/api/products`;
            axios.get(url, {
                params: {
                    per_page: this.perPage,
                    page: this.page,
                    categories: this.categories,
                    search: this.search
                }
            })
                .then(response => {
                    this.loading = false;
                    this.products = response.data.data;
                    this.paginationData = response.data.meta;
                })
                .catch(error => console.error(error))
        },
        getPage(page) {
            this.page = page;
            this.getProducts();
        },
        fetchCategories(categories) {
            this.categories = categories;
            this.getProducts();
        },
        searchProducts(query) {
            this.search = query;
            this.getProducts();
        },
        resetFilters() {
            this.search = null;
            this.categories = [];
            this.page = 1;
            this.$refs.searchBar.reset();
            this.$refs.categoryList.reset();
        }
    }
}
</script>

<style scoped>

</style>
