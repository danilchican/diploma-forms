<template>
    <div>
        <div v-for="(item, index) in questions">
            <span class="section">{{ index + 1 }}. {{ item.question_title }}</span>
            <v-chart v-if="item.diagram !== 'list'" :options="getDiagramOptions(item)"></v-chart>
            <div class="row" v-else>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <blockquote v-for="(answer, index) in item.answers" class="col-md-6">
                        <p>{{ index + 1 }}. {{ answer }}</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ECharts from 'vue-echarts'
    import 'echarts/lib/chart/pie'
    import 'echarts/lib/chart/bar'
    import 'echarts/lib/component/tooltip'

    export default {
        props: ['formQuestions'],

        data() {
            return {
                questions: []
            }
        },

        mounted() {
            this.questions = this.formQuestions
        },

        methods: {
            getDiagramOptions(item) {
                if (item.diagram === 'pie') {
                    return this.getPieDiagramOptions(item)
                }

                return {}
            },

            getPieDiagramOptions(item) {
                return {
                    tooltip: {
                        trigger: 'item',
                        formatter: "Количество: {c} ({d}%)"
                    },
                    series: [
                        {
                            name: item.question_title,
                            type: 'pie',
                            showSymbol: false,
                            data: this.getDiagramDataByAnswers(item.answers),
                            animationType: 'scale',
                            animationEasing: 'elasticOut',
                        }
                    ],
                }
            },

            getDiagramDataByAnswers(answers) {
                let data = [];

                for (let i = 0; i < answers.length; i++) {
                    data.push({
                        name: answers[i].title,
                        value: answers[i].count,
                        labelLine: 'asdasd'
                    })
                }

                return data;
            }
        },

        components: {
            'v-chart': ECharts
        }
    }
</script>

<style>
    .echarts {
        width: 100%;
        height: 200px;
    }
</style>