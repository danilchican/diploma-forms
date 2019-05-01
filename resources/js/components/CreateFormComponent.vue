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
                        <div id="questions-list" v-if="questions.length > 0">
                            <draggable v-model="questions"
                                       handle=".handle"
                                       v-bind="dragOptions"
                                       @start="drag = true"
                                       @end="drag = false"
                                       :options="{group:{name:'questions', pull: false, put: false}}">
                                <transition-group type="transition" :name="!drag ? 'flip-questions' : null">
                                    <div class="question-item" v-for="(question, index) in questions"
                                         :key="question.title">
                                        <span class="handle"><i class="fa fa-sort"></i></span>&nbsp;
                                        {{ index + 1 }}. {{ question.title }}
                                        <span class="pull-right" style="display: flex">
                                             <button @click="editQuestion(index)" type="button"
                                                     class="btn btn-xs btn-primary" :disabled="isQuestionEdit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button @click="deleteQuestion(index)" type="button"
                                                    class="btn btn-xs btn-danger">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </span>
                                    </div>
                                </transition-group>
                            </draggable>
                        </div>
                        <div class="clearfix"></div>
                        <add-or-edit-question :index="questions.length + 1"
                                              :answerTypes="answerTypes"
                                              :isQuestionEdit="isQuestionEdit"
                                              :editQuestionIndex="editQuestionIndex"
                                              @questionCreated="addQuestion"
                                              @questionUpdated="updateQuestion"/>
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
    import AddOrEditQuestionComponent from './AddOrEditQuestionComponent'
    import AddMainInformationComponent from './FormMainInformationComponent'

    export default {
        props: ['answerTypes', 'storeUrl', 'declineUrl'],

        data() {
            return {
                drag: false,
                isQuestionEdit: false,
                editQuestionIndex: null,
                title: '',
                description: '',
                questions: [],
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
            remove(index) {
                this.questions.splice(index, 1)
            },

            onMainInfoChanged(info) {
                this.title = info.title
                this.description = info.description
            },

            addQuestion(question) {
                this.questions.push(question)
            },

            updateQuestion(question) {
                this.questions[question.index] = question
            },

            deleteQuestion(index) {
                this.questions.splice(index, 1)
            },

            editQuestion(index) {
                this.editQuestionIndex = index
                this.isQuestionEdit = true
            }
        },

        components: {
            'draggable': draggable,
            'add-or-edit-question': AddOrEditQuestionComponent,
            'add-main-information': AddMainInformationComponent
        }
    }
</script>
