<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';
import { Core as  YubinBangoCore} from 'yubinbango-core2';

defineProps({
  errors: Object
})

const form = reactive({
  name: null,
  kana: null,
  tel: null,
  email: null,
  postcode: null,
  address: null,
  birthday: null,
  gender: null,
  memo: null
})

const storeCustomers = () => {
  Inertia.post('/custmoer', form);
}

const fetchAddress = () => {
  new YubinBangoCore(String(form.postcode), (value) => {
  form.address = value.region + value.locality + value.street
  })
}

</script>

<template>
    <Head title="顧客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客登録</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <section class="text-gray-600 body-font relative">
                    <form @submit.prevent="storeCustomers" type="POST">
                        <div class="container px-5 py-24 mx-auto">
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                          <div v-for="error in errors" :key="error">
                            <div class="text-white bg-red-400 text-center">{{ error }}</div>
                          </div>
                          <div class="flex flex-wrap -m-2 mt-8">
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                <input type="text" id="name" v-model="form.name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="kana" class="leading-7 text-sm text-gray-600">カナ</label>
                                <input type="text" id="kana" v-model="form.kana" name="kana" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="tel" class="leading-7 text-sm text-gray-600">電話番号</label>
                                <input type="tel" id="tel" v-model="form.tel" name="tel" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                <input type="email" id="email" v-model="form.email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="postcode" class="leading-7 text-sm text-gray-600">郵便番号</label>
                                <input type="text" id="postcode" @change="fetchAddress" v-model="form.postcode" name="postcode" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                <input type="text" id="address" v-model="form.address" name="address" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="birthday" class="leading-7 text-sm text-gray-600">誕生日</label>
                                <input type="date" id="birthday" v-model="form.birthday" name="birthday" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label class="leading-7 text-sm text-gray-600 pr-4">性別</label>
                                <input type="radio" v-model="form.gender" value="0" name="gender" id="gender0">
                                <label for="gender0">男性</label>
                                <input type="radio" v-model="form.gender" value="1" name="gender" id="gender1">
                                <label for="gender1">女性</label>
                                <input type="radio" v-model="form.gender" value="2" name="gender" id="gender2">
                                <label for="gender2">その他</label>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                                <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">顧客登録</button>
                            </div>
                          </div>
                        </div>
                      </div>                      
                    </form>
                  </section>
                </div>
            </div>
        </div>
      </AuthenticatedLayout>
</template>
