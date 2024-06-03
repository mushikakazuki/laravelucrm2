<script setup>
import axios from 'axios';
import {ref, reactive} from 'vue'

const emit = defineEmits(['update:customerld'])

const search = ref('');
const customers = reactive({});
const searchCustomers = async() => {
    try {
    await axios.get(`/api/searchCustomers/?search=${search.value}`)
    .then(res => {
        console.log(res.data);

        customers.value = res.data
    })
    toggleStatus();
    } catch(e) {
        console.log(e.message);
    }
}
const isShow = ref(false);
const toggleStatus = () => {isShow.value = !isShow.value};

const setCustomer = e => {
    search.value = e.kana;
    emit('update:customerld', e.id);
    toggleStatus();
}
</script>
<template>
      <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container w-2/3" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Micromodal
          </h2>
          <button type="button" @click="toggleStatus" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
            <div v-if="customers.value">
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
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">電話番号</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers.value.data" :key="customer.id">
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                                    <button @click="setCustomer({ id: customer.id, kana: customer.kana })" type="button" class="text-blue-400">
                                        {{ customer.id }}
                                    </button>
                            </td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.name }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.kana }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200 text-lg text-gray-900">{{ customer.tel }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                                <button class="text-red-400 bg-gray-300 p-2" @click="deleteItem(customer.id)">
                                    削除
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="mt-6" :links="customers.links" />
            </div>
        </div>
        </main>
        <footer class="modal__footer">
          <button type="button" @click="toggleStatus" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
        </footer>
      </div>
    </div>
  </div>
  <input name="customer" v-model="search">
  <button type="button" class="btn bg-teal-300 p-2 mx-2" @click="searchCustomers">検索する</button>
  <button type="button" data-micromodal-trigger="modal-1" href='javascript:;' @click="toggleStatus">モーダルを開く</button>
</template>