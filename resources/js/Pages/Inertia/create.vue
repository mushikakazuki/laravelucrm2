<script setup>
    import { reactive } from 'vue';
    import { Inertia } from '@inertiajs/inertia'
const form = reactive({
    title:null,
    content:null
})

defineProps({
    errors: Object
})

const submitfunction = () => {
    Inertia.post('/inertia/store', form);
}
</script>

<template>
    <div v-if="errors.title">{{ errors.title }}</div>
    <div v-if="errors.content">{{ errors.content }}</div>
    <form @submit.prevent="submitfunction">
        タイトル：<input type="text" name="title" v-model="form.title"><br>
        本文：<input type="text" name="content" v-model="form.content"><br>
        <button>送信</button>
    </form>
</template>