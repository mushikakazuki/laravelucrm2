<script setup>
    const props = defineProps({
        'data':Object
    })
</script>

<template>
    <div v-if="data.type == 'preDay' || data.type == 'preMonth' || data.type == 'preYear'" class="lg:w-2/3 w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">年月日</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in data.data" :key="data.date">
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.date }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.total }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="data.type == 'decile'" class="lg:w-2/3 w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">グループ</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">平均</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">構成比</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in data.data" :key="data.decile">
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.decile }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.average }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.totalPerGroup }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ data.totalRatio }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="data.type == 'rfm'" class="lg:w-2/3 w-full mx-auto overflow-auto">
        RFM集計
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Rank</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">R</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">M</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="rfm in data.eachCount" :key="rfm.rank">
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.rank }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.r }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.f }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.m }}</td>
                </tr>
            </tbody>
        </table>

        RとF
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">frank</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_5</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_4</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_3</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_2</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_1</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="rf in data.data" :rf.rRank>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.rRank }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_5 }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_4 }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_3}}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_2 }}</td>
                    <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_1 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>