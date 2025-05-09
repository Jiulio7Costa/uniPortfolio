<script setup>
import { Link, router } from "@inertiajs/vue3";
import UserLayouts from "./Layouts/UserLayouts.vue";
import Hero from "./Layouts/Hero.vue";
import Products from '../User/Components/Products.vue';

//Products List
defineProps({
    products: Array,
});


</script>
<template>
    <UserLayouts>
        <!--hero section-->
        <Hero></Hero>
        <!--end-->
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    List of Products
                </h2>

                <!-- product list component-->
                  <Products :products="products"></Products>
                

                <!--end-->

                <div class="flex justify-center mt-5">
                    <Link :href="route('products.index')"
                        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        View all products
                </Link>
                </div>
            </div>
        </div>
    </UserLayouts>
</template>
