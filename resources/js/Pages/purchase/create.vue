<script setup>
  import { toDayGet } from '@/common'
  import { onMounted, reactive, ref, computed } from 'vue';
  import { Inertia } from '@inertiajs/inertia';
  import MicroModal from '@/Components/MicroModal.vue'

  onMounted(() => {
    form.date = toDayGet();
    props.items.forEach(item => {
      itemList.value.push({
        id: item.id, name: item.name, price: item.price, quantity: 0
      })
    })
  })

  const setCustomerId = id => {
    form.customer_id = id;
  }

  const quantity = [0,1,2,3,4,5,6,7,8,9]

  const form = reactive({ 
    date: null,
    customer_id: null,
    status: true,
    items: []
  })

  const props = defineProps({
    customers: Array,
    items: Array
  })

  const itemList = ref([]);


  const totalprice = computed(() => {
    let total = 0;
    itemList.value.forEach(item => {
      total += item.price * item.quantity;
    })
    return total;
  })

  const storePurchesa =  () => {
    itemList.value.forEach(item => {
      if(item.quantity > 0) {
        form.items.push({id: item.id, quantity: item.quantity});
      }
    })
    Inertia.post(route('purchase.store'), form)
    form.items= [];
  }

</script>

<template>
  <form @submit.prevent="storePurchesa()">
    日付<br>
    <input type="date" name="date" v-model="form.date">
    <br>
    <br>
    購入者<br>
    <select name="customer" v-model="form.customer_id" >
      <option v-for="customer in customers" :key="customer.id" :value="customer.id">
        {{ customer.id }}: {{ customer.name }}
      </option>
    </select>
    <br>
    <br>
    <MicroModal @update:customerld="setCustomerId"></MicroModal>
    <br>
    <br>
    商品・サービス<br>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>料金</th>
          <th>個数</th>
          <th>小計</th>
        </tr>
      </thead>
    <tbody>
      <tr v-for="item in itemList" >
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.price }}</td>
        <td>
        <select name="quantity" v-model="item.quantity">
          <option v-for="q in quantity" :value="q">{{ q }}</option>
        </select>
        </td>
        <td>
        {{ item.price * item.quantity }}
        </td>
      </tr>
    </tbody>
    </table>
    <br>
    合計：{{ totalprice }}円 <br>
    <button class="btn bg-red-600 p-4 mx-2">登録する</button>
  </form>
</template>
