<script setup>
import { onMounted, ref, nextTick } from 'vue'
import { router } from "@inertiajs/vue3";
import Swiper from 'swiper/bundle'
import 'swiper/css/bundle'

import UserLayouts from './Layouts/UserLayouts.vue'

defineProps({
    products: Object,
})

const swiperRef = ref(null)

onMounted(() => {
    // Used $nextTick to ensure DOM is fully rendered before Swiper initializes
    nextTick(() => {
        new Swiper('.swiper', {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
});
const addToCart = (product) => {
    console.log(product);
    router.post(route("cart.store", product), {
        onSuccess: (page) => {
            if (page.props.flash.success) {
                Swal.fire({
                    toast: true,
                    icon: "success",
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
    <UserLayouts>
        <div class="bg-gray-100 py-10">
            <div class="flex-grow overflow-y-auto bg-gray-100 py-10">
                <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row gap-8">

                <!-- Left side Product Images -->
                <div class="w-full md:w-1/2">
                    <div v-if="products.product_images && products.product_images.length > 0">
                        <div class="swiper" ref="swiperRef">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" v-for="(image, index) in products.product_images"
                                    :key="index">
                                    <img :src="`/${image.image}`" alt="Product Image"
                                        class="w-full rounded-lg shadow-md" />
                                </div>
                            </div>

                            <!-- Navigation -->
                            <div class="swiper-button-prev text-gray-800"></div>
                            <div class="swiper-button-next text-gray-800"></div>
                        </div>
                    </div>
                    <div v-else>
                        <img src="data:image/jpeg;base64,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"
                            alt="NoImage" class="w-full rounded-lg shadow-md" />
                    </div>
                </div>

                <!-- Right side Product Details -->
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-bold mb-2">{{ products.title }}</h2>
                    <h3 class="text-gray-600 text-lg mb-4">{{ products.brand.name }}</h3>
                    <p class="text-gray-700 mb-6">{{ products.description || 'No description available' }}</p>
                    <div class="text-2xl font-bold text-indigo-700 mb-4">€{{ products.price }}</div>
                    <a @click="addToCart(products)"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 focus:outline-none transition">
                        Add to Cart
                    </a>
                </div>
                </div>
            </div>
        </div>
    </UserLayouts>
</template>
