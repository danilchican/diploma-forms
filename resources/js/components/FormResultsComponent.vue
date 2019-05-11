<template>
    <div v-if="questions.length > 0">
        <div v-for="(item, index) in questions">
            <span class="section">{{ index + 1 }}. {{ item.question_title }}</span>
            <v-chart v-if="item.diagram !== 'list'" :options="getDiagramOptions(item)"></v-chart>
            <div class="row" v-else>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <blockquote v-for="answer in item.answers" class="col-md-6">
                        <p>{{ answer }}</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <p v-else>На данный момент результаты опроса отсутствуют.</p>
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
            this.sortAnswers();
        },

        methods: {
            getDiagramOptions(item) {
                if (item.diagram === 'pie') {
                    return this.getPieDiagramOptions(item)
                }

                return this.getHorizontalBarDiagramOptions(item)
            },

            getHorizontalBarDiagramOptions(item) {
                return {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'value',
                        boundaryGap: [0, 0]
                    },
                    yAxis: {
                        type: 'category',
                        data: Object.values(item.answers).map(a => a.title + ' (' + a.percentage + '%)')
                    },
                    series: [
                        {
                            type: 'bar',
                            color: ['#3366cc'],
                            sort: 'ascending',
                            data: Object.values(item.answers).map(a => a.count)
                        },
                    ]
                }
            },

            getPieDiagramOptions(item) {
                return {
                    tooltip: {
                        formatter: "Количество: {c} ({d}%)"
                    },
                    series: [
                        {
                            type: 'pie',
                            showSymbol: false,
                            data: Object.values(item.answers).map(function (a) {
                                return {name: a.title, value: a.count}
                            }),
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 5,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.3)'
                                }
                            },
                            color: ['#109618', '#dc3912', '#ff9900', '#990099', '#3366cc'],
                            animationType: 'scale',
                            animationEasing: 'elasticOut',
                        }
                    ],
                }
            },

            sortAnswers() {
                for (let i = 0; i < this.questions.length; i++) {
                    let answers = Object.values(this.questions[i].answers);

                    if (this.questions[i].diagram !== 'horizontal') {
                        continue;
                    }

                    this.questions[i].answers = answers.sort(function (a, b) {
                        if (a.count < b.count) {
                            return -1;
                        }

                        if (a.count > b.count) {
                            return 1;
                        }

                        return 0;
                    });
                }
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