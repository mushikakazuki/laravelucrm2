<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, onMounted } from 'vue';
import { toDayGet } from '@/common';
import axios from 'axios';
import Chart from '@/Components/Chart.vue'
import ResultTable from '@/Components/ResultTable.vue'

const form = reactive({
    startDate: null,
    endDate: null,
    type: 'preDay',
    rfmPrms: [
        14, 28, 60, 90, 7, 5, 3, 2, 300000, 200000, 100000,30000
    ],
})

const data = reactive({});

onMounted(() => {
    form.startDate = toDayGet();
    form.endDate = toDayGet();
})

const getDate = async() => {
    try {
        await axios.get('api/analysis', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type,
                rfmPrms: form.rfmPrms
            }
        }).then(res => {
            console.log(res.data)
            data.data = res.data.data;
            if(res.data.labels) {data.labels = res.data.labels}
            if(res.data.eachCount) {data.eachCount = res.data.eachCount}
            data.totals = res.data.totals;
            data.type = res.data.type;
        })
    } catch (error) {
        console.log(error)
    }
}
</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="getDate">
                        分析方法<br>
                        <input type="radio" v-model="form.type" value="preDay" checked><span class="mr-2">年月日</span>
                        <input type="radio" v-model="form.type" value="preMonth"><span class="mr-2">年月</span>
                        <input type="radio" v-model="form.type" value="preYear"><span class="mr-2">年</span>
                        <input type="radio" v-model="form.type" value="decile"><span class="mr-2">デシル分析</span>
                        <input type="radio" v-model="form.type" value="rfm"><span class="mr-2">RFM分析</span>
                        <br>
                        <br>
                        From: <input type="date" name="startDate" v-model="form.startDate">
                        To: <input type="date" name="endDate" v-model="form.endDate"><br><br>
                        <div v-if="form.type === 'rfm'" class="my-8">
                            <table class="mx-auto">
                                <thead>
                                    <tr>
                                        <th>ランク</th>
                                        <th>R (○日以内)</th>
                                        <th>F (○回以上)</th>
                                        <th>M (○円以上)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="number" v-model="form.rfmPrms[0]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[4]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[8]"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="number" v-model="form.rfmPrms[1]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[5]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[9]"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="number" v-model="form.rfmPrms[2]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[6]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[10]"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="number" v-model="form.rfmPrms[3]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[7]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[11]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn bg-lime-200 mx-4">分析する</button>
                    </form>

                    <div v-show="data.data">
                        <div v-if="form.type != 'rfm'">
                            <Chart :data="data"></Chart>
                        </div>
                        <ResultTable :data="data"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
