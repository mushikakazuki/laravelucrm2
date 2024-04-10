<script setup>
import Layout from '@/Layouts/GuestLayout.vue'; // パスを修正
import Label from '@/Components/InputLabel.vue';
import Input from '@/Components/TextInput.vue'; // コンポーネント名を修正

const emittest = e => console.log(e)
</script>

<template>
  <Layout>
    <Label value="件名">テスト</Label>
    <Input modelValue="初期値" @update:modelValue="emittest"></Input>
  </Layout>
</template>