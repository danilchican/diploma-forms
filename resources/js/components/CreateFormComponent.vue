<template>
    <div>
        <div class="page-title">
            <div class="title_left"><h3>Добавление нового опроса</h3></div>
        </div>
        <add-main-information @infoChanged="onMainInfoChanged"></add-main-information>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Вопросы ({{ questions.length }})</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul v-if="questions.length > 0">
                            <draggable v-model="questions" :clone="clone"
                                       handle=".handle"
                                       v-bind="dragOptions"
                                       @start="drag = true"
                                       @end="drag = false"
                                       :options="{group:{name:'questions', pull:'clone', put: false}}">
                                <transition-group type="transition" :name="!drag ? 'flip-questions' : null">
                                    <li v-for="(question, index) in questions" :key="question.title">
                                        <p>{{ index + 1 }}. {{ question.title }}</p>
                                        <button type="button" class="handle">...</button>
                                    </li>
                                </transition-group>
                            </draggable>
                        </ul>
                        <p v-else>Добавьте первый вопрос.</p>
                        <div class="clearfix"></div>
                        <add-question @questionCreated="addQuestion"></add-question>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <button type="button" class="btn btn-md btn-success pull-right">Сохранить опрос</button>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import AddQuestionComponent from './AddQuestionComponent'
    import AddMainInformationComponent from './FormMainInformationComponent'

    export default {
        props: ['storeUrl', 'declineUrl'],

        data() {
            return {
                drag: false,
                title: '',
                description: '',
                questions: [],
                editableQuestion: {
                    index: null,
                    title: ''
                }
            }
        },

        watch: {
            questions() {
                console.log(this.questions)
            }
        },

        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        },

        methods: {
            clone(original) {
                return JSON.parse(JSON.stringify(original))
            },

            remove(index) {
                this.questions.splice(index, 1)
            },

            onMainInfoChanged(info) {
                this.title = info.title
                this.description = info.description
            },

            addQuestion(question) {
                console.log(question);
                this.questions.push(question)
                console.log('question is added.')
            }
        },

        components: {
            'draggable': draggable,
            'add-question': AddQuestionComponent,
            'add-main-information': AddMainInformationComponent
        }
    }
</script>
