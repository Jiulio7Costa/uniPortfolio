<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    products: Array
})

const addToCart = (product) => {
    console.log(product);
    router.post(route("cart.store", product), {
        onSuccess: (page) => {
            if (page.props.flash.success) {
                Swal.fire({
                    toast: true,
                    icon: "Success",
                    position: "top-end",
                    showConfirmationButton: false,
                    title: page.props.flash.success,
                });
            }
        },
    });
};
</script>

<template>
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div v-for="product in products" :key="product.id" class="group relative">
            <img v-if="product.product_images.length > 0" :src="`/${product.product_images[0].image}`"
                :alt="product.imageAlt"
                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <img v-else
                src="data:image/png;base64,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"
                :alt="product.imageAlt"
                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />

            <!-- add to cart icon-->
            <div
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                <!-- First Button -->
                <div class="bg-blue-700 p-2 rounded-full mr-2">
                    <!-- Added mr-2 for margin to the right -->
                    <a @click="addToCart(product)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </a>
                </div>

                <!-- Second Button -->
                <div class="bg-blue-700 p-2 rounded-full">
                    <a :href="`/products/${product.id}`"> 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- end -->
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-700">
                        <span aria-hidden="true" class="inset-0" />
                        {{ product.title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ product.brand.name }}
                    </p>
                </div>
                <p class="text-sm font-medium text-gray-900">
                    €{{ product.price }}
                </p>
            </div>
        </div>
    </div>
</template>