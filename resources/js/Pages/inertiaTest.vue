<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const newTitle = ref('');
const newContent = ref('');
</script>

<template>
    inertiaテストです。<br>
    <a href="/">aタグ経由</a><br>
    <Link href="/">Linkタグ経由</Link><br>
    <Link :href="route('inertia.index')">名前付きルート</Link><br>
    <Link :href="route('inertia.show', {id: 100})">パラメータ有り</Link><br>

    <div class="md-8"></div>
    <input type="text" name="newTitle" v-model="newTitle" />{{ newTitle }}<br>
    <input type="text" name="newContent" v-model="newContent" />{{ newContent }}<br>
    <Link as="button" :href="route('inertia.store')" method="post"
    :data="{ 
        title:newTitle,
        content: newContent
        }">DB:保存テスト</Link>
</template>