<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue'
import { Inertia } from '@inertiajs/inertia';
import Pagination from '@/Components/Pagination.vue'
import { onMounted } from 'vue';

defineProps({
    orders: Object
})

</script>
<template>
    <Head title="購買履歴" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                          <FlashMessage />
                            <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                            </div>
                            <div>
                              <input type="text" name="search" v-model="search"/>
                              <button @click="searchText">検索</button>
                            </div>
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Id</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ステータス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">購入日</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="order in orders.data" :key="order.id">
                                            <td class="px-4 py-3 border-b-2 border-gray-200">
                                              <Link class="text-blue-400" :href="route('purchase.show', {purchase: order.id})">
                                                {{ order.id }}
                                              </Link>
                                            </td>
                                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ order.customer_name }}</td>
                                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ order.total }}</td>
                                            <td class="px-4 py-3 border-b-2 border-gray-200 text-lg text-gray-900">{{ order.status }}</td>
                                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ order.created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination class="mt-6" :links="orders.links" />
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
