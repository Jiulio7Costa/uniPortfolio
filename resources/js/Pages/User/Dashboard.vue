<script setup>
import UserLayouts from './Layouts/UserLayouts.vue'

defineProps({
  orders: Array
})
</script>

<template>
  <UserLayouts>
    <div class="relative max-w-screen-xl py-8 mx-auto px-4 mt-4">
      <div class="space-y-6 max-h-[500px] overflow-y-auto pr-2">

        <!-- Order Card -->
        <div
          v-for="order in orders"
          :key="order.id"
          class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-4 border dark:border-gray-700"
        >
          <!-- Order Header -->
          <div class="mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
              Order ID #{{ order.id }}
            </h2>
          </div>

          <!-- Table of Items -->
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
              <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-500 dark:text-gray-300">
                <tr>
                  <th class="px-4 py-2">Product</th>
                  <th class="px-4 py-2">Brand</th>
                  <th class="px-4 py-2">Category</th>
                  <th class="px-4 py-2">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="item in order.order_items"
                  :key="item.id"
                  class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                  <td class="px-4 py-2 font-medium">
                    {{ item.product.title }}
                  </td>
                  <td class="px-4 py-2">
                    {{ item.product.brand.name }}
                  </td>
                  <td class="px-4 py-2">
                    {{ item.product.category.name }}
                  </td>
                  <td class="px-4 py-2">
                    €{{ item.product.price }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Order Card -->

      </div>
    </div>
  </UserLayouts>
</template>
