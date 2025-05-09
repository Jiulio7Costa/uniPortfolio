<template>
  <AdminLayout>
    <div class="p-6">
      <h1 class="text-3xl font-semibold text-gray-800 mb-8">Admin Dashboard</h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- User Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex items-center gap-4">
          <div class="bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-100 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H5v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Users</p>
            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ userCount }}</p>
          </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex items-center gap-4">
          <div class="bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-100 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v6H3V3zm0 6h18v12H3V9zm3 4h3v4H6v-4z" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Orders</p>
            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ orderCount }}</p>
          </div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex items-center gap-4">
          <div class="bg-yellow-100 text-yellow-600 dark:bg-yellow-800 dark:text-yellow-100 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd"
                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.902 7.098a3.75 3.75 0 0 1 3.903-.884.75.75 0 1 0 .498-1.415A5.25 5.25 0 0 0 8.005 9.75H7.5a.75.75 0 0 0 0 1.5h.054a5.281 5.281 0 0 0 0 1.5H7.5a.75.75 0 0 0 0 1.5h.505a5.25 5.25 0 0 0 6.494 2.701.75.75 0 1 0-.498-1.415 3.75 3.75 0 0 1-4.252-1.286h3.001a.75.75 0 0 0 0-1.5H9.075a3.77 3.77 0 0 1 0-1.5h3.675a.75.75 0 0 0 0-1.5h-3c.105-.14.221-.274.348-.402Z"
                clip-rule="evenodd" />
            </svg>

          </div>
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Revenue</p>
            <p class="text-xl font-bold text-gray-800 dark:text-white">€{{ totalRevenue.toLocaleString() }}</p>
          </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex items-center gap-4">
          <div class="bg-purple-100 text-purple-600 dark:bg-purple-800 dark:text-purple-100 p-3 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7M3 17h18M9 21h6" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-300">Total Products</p>
            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ productCount }}</p>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
defineProps({
  userCount: Number,
  orderCount: Number,
  productCount: Number,
  totalRevenue: {
    type: Number,
    default: 0
  }
})

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import AdminLayout from './Components/AdminLayout.vue'

onMounted(() => {
  initFlowbite()
})
</script>