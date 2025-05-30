<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
import { router, useForm } from '@inertiajs/vue3'

import { ref, watch } from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon } from '@heroicons/vue/20/solid'
import Products from '../User/Components/Products.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue';

const sortOptions = [
    { name: 'Most Popular', href: '#', current: true },
    { name: 'Best Rating', href: '#', current: false },
    { name: 'Newest', href: '#', current: false },
    { name: 'Price: Low to High', href: '#', current: false },
    { name: 'Price: High to Low', href: '#', current: false },
]



const filterPrices = useForm({
    prices: [0, 10000]
})

//price filter method
const priceWarning = ref('')

const priceFilter = () => {
    const [min, max] = filterPrices.prices

    // Show warning if max price is zero
    if (max === 0) {
        priceWarning.value = 'Please enter a price above zero.'
        return
    }

    // Clear warning before making request
    priceWarning.value = ''
    filterPrices.transform((data) => ({
        ...data,
        prices: {
            from: filterPrices.prices[0],
            to: filterPrices.prices[1]
        }

    })).get('products', {
        preserveState: true,
        replace: true
    });


}

const mobileFiltersOpen = ref(false)

const props = defineProps({
    products: Array,
    categories: Array,
    brands: Array
})

//brands and categories filtering
const selectedBrands = ref([])
const selectedCategories = ref([])

watch(selectedBrands, () => {
    //update the filtered products when the selectBrands changes
    updateFilteredProducts()
})

watch(selectedCategories, () => {
    //update the filtered products when the selectCategories changes
    updateFilteredProducts()
})

function updateFilteredProducts() {
    router.get('products', {
        brands: selectedBrands.value,
        categories: selectedCategories.value
    }, {
        preserveState: true,
        replace: true
    })
}
</script>

<template>
    <UserLayouts>
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <!-- Mobile filter dialog -->
<TransitionRoot as="template" :show="mobileFiltersOpen">
    <Dialog class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
            enter-from="opacity-0" enter-to="opacity-100"
            leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
            leave-to="opacity-0">
            <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 z-40 flex">
            <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                enter-from="translate-x-full" enter-to="translate-x-0"
                leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                leave-to="translate-x-full">
                <DialogPanel
                    class="relative ml-auto flex size-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button type="button"
                            class="-mr-2 flex size-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                            @click="mobileFiltersOpen = false">
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="size-6" aria-hidden="true" />
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4 border-t border-gray-200 px-4">
                        <!-- Price Filter -->
                        <div class="py-6">
                            <h3 class="mb-4 font-medium text-gray-900">Price Range</h3>
                            <div class="flex items-center justify-between space-x-3">
                                <div class="basis-1/3">
                                    <label for="mobile-filters-price-from"
                                        class="mb-2 block text-sm font-medium text-gray-900">
                                        From
                                    </label>
                                    <input type="number" id="mobile-filters-price-from" placeholder="Min price"
                                        v-model="filterPrices.prices[0]"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" />
                                </div>
                                <div class="basis-1/3">
                                    <label for="mobile-filters-price-to"
                                        class="mb-2 block text-sm font-medium text-gray-900">
                                        To
                                    </label>
                                    <input type="number" id="mobile-filters-price-to" placeholder="Max price"
                                        v-model="filterPrices.prices[1]"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" />
                                </div>
                                <SecondaryButton class="self-end" @click="priceFilter(); mobileFiltersOpen = false">
                                    Ok
                                </SecondaryButton>
                            </div>
                            <p v-if="priceWarning" class="text-sm text-red-600 mt-2">
                                {{ priceWarning }}
                            </p>
                        </div>

                        <!-- Brands Filter -->
                        <Disclosure as="div" class="border-t border-gray-200 py-6" v-slot="{ open }">
                            <h3 class="-my-3 flow-root">
                                <DisclosureButton
                                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                    <span class="font-medium text-gray-900">Brands</span>
                                    <span class="ml-6 flex items-center">
                                        <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                                        <MinusIcon v-else class="size-5" aria-hidden="true" />
                                    </span>
                                </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-4">
                                    <div v-for="brand in brands" :key="brand.id" class="flex gap-3">
                                        <div class="flex h-5 shrink-0 items-center">
                                            <div class="group grid size-4 grid-cols-1">
                                                <input :id="`mobile-filter-${brand.id}`" :value="brand.id"
                                                    type="checkbox" v-model="selectedBrands"
                                                    class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" />
                                                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path class="opacity-0 group-has-[:checked]:opacity-100"
                                                        d="M3 8L6 11L11 3.5" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                                        d="M3 7H11" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                        <label :for="`mobile-filter-${brand.id}`" class="text-sm text-gray-600">{{
                                            brand.name}}</label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>

                        <!-- Categories Filter -->
                        <Disclosure as="div" class="border-t border-gray-200 py-6" v-slot="{ open }">
                            <h3 class="-my-3 flow-root">
                                <DisclosureButton
                                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                    <span class="font-medium text-gray-900">Categories</span>
                                    <span class="ml-6 flex items-center">
                                        <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                                        <MinusIcon v-else class="size-5" aria-hidden="true" />
                                    </span>
                                </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-4">
                                    <div v-for="category in categories" :key="category.id" class="flex gap-3">
                                        <div class="flex h-5 shrink-0 items-center">
                                            <div class="group grid size-4 grid-cols-1">
                                                <input :id="`mobile-filter-${category.id}`" :value="category.id"
                                                    type="checkbox" v-model="selectedCategories"
                                                    class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" />
                                                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path class="opacity-0 group-has-[:checked]:opacity-100"
                                                        d="M3 8L6 11L11 3.5" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                                        d="M3 7H11" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                        <label :for="`mobile-filter-${category.id}`" class="text-sm text-gray-600">{{
                                            category.name}}</label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </form>
                </DialogPanel>
            </TransitionChild>
        </div>
    </Dialog>
</TransitionRoot>

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">All Products</h1>

                        <div class="flex items-center">
                               
                            <button type="button"
                                class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true">
                                <span class="sr-only">Filters</span>
                                <FunnelIcon class="size-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>

                    <section aria-labelledby="products-heading" class="pb-24 pt-6">
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                            <!-- Filters -->
                            <form class="hidden lg:block">
                                <h3 class="sr-only">Prices</h3>
                                <!-- price filter-->
                                <div class="flex items-center justify-between space-x-3">
                                    <div class="basis-1/3">
                                        <label for="filters-price-from"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                            From
                                        </label>

                                        <input type="number" id="filters-price-from" placeholder="Min price"
                                            v-model="filterPrices.prices[0]"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                                    </div>
                                    <div class="basis-1/3">
                                        <label for="filters-price-to"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                            To
                                        </label>

                                        <input type="number" id="filters-price-to" placeholder="Max price"
                                            v-model="filterPrices.prices[1]"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                                    </div>
                                    <SecondaryButton class="self-end" @click="priceFilter()">
                                        Ok
                                    </SecondaryButton>
                                </div>

                                <!--text displayed when max price is set 0-->

                                <p v-if="priceWarning" class="text-sm text-red-600 mt-2">
                                    {{ priceWarning }}
                                </p>
                                <!-- end-->

                                <Disclosure as="div" class="border-b border-gray-200 py-6" v-slot="{ open }">
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Brands</span>
                                            <span class="ml-6 flex items-center">
                                                <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                                                <MinusIcon v-else class="size-5" aria-hidden="true" />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="brand in brands" :key="brand.id" class="flex gap-3">
                                                <div class="flex h-5 shrink-0 items-center">
                                                    <div class="group grid size-4 grid-cols-1">
                                                        <input :id="`filter-${brand.id}`" :value="brand.id"
                                                            type="checkbox" v-model="selectedBrands"
                                                            class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path class="opacity-0 group-has-[:checked]:opacity-100"
                                                                d="M3 8L6 11L11 3.5" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                                                d="M3 7H11" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <label :for="`filter-${brand.id}`" class="text-sm text-gray-600">{{
                                                    brand.name}}</label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>


                                <!-- category filter-->

                                <Disclosure as="div" class="border-b border-gray-200 py-6" v-slot="{ open }">
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Categories</span>
                                            <span class="ml-6 flex items-center">
                                                <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                                                <MinusIcon v-else class="size-5" aria-hidden="true" />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="category in categories" :key="category.id" class="flex gap-3">
                                                <div class="flex h-5 shrink-0 items-center">
                                                    <div class="group grid size-4 grid-cols-1">
                                                        <input :id="`filter-${category.id}`" :value="category.id"
                                                            type="checkbox" v-model="selectedCategories"
                                                            class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path class="opacity-0 group-has-[:checked]:opacity-100"
                                                                d="M3 8L6 11L11 3.5" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                                                d="M3 7H11" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <label :for="`filter-${category.id}`" class="text-sm text-gray-600">{{
                                                    category.name}}</label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>


                                <!--end-->

                            </form>

                            <!-- Product grid -->
                            <div class="lg:col-span-3">
                                <!-- Your content -->
                                <Products :products="products.data"></Products>

                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </UserLayouts>

</template>