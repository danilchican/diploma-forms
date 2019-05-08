<template>
    <div>
        <div class="page-title">
            <div class="title_left"><h3>{{ editTitle }}</h3></div>
        </div>
        <add-main-information :edit-title="form.title"
                              :edit-description="form.description"
                              :edit-published="form.is_published"
                              :edit-finished="form.is_finished"
                              :is-edit-form="true"
                              @infoChanged="onMainInfoChanged"/>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Вопросы ({{ questions.length }}) <span style="color: #d40707;">*</span></h2>
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
                                                    class="btn btn-xs btn-danger" :disabled="isQuestionEdit">
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
                                              :delete-answer-variant-url="deleteAnswerVariantUrl"
                                              @questionCreated="addQuestion"
                                              @questionUpdated="updateQuestion"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <button @click="updateForm" type="button" class="btn btn-md btn-success pull-right">
                    Сохранить опрос
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import AddOrEditQuestionComponent from './AddOrEditQuestionComponent'
    import AddMainInformationComponent from './FormMainInformationComponent'

    export default {
        props: [
            'form', 'answerTypes',
            'updateUrl', 'deleteQuestionUrl', 'deleteAnswerVariantUrl'
        ],

        data() {
            return {
                drag: false,
                isQuestionEdit: false,
                editQuestionIndex: null,
                id: null,
                title: '',
                description: '',
                published: null,
                finished: null,
                questions: [],
            }
        },

        mounted() {
            this.id = this.form.id
            this.title = this.form.title
            this.description = this.form.description
            this.published = this.form.is_published
            this.finished = this.form.is_finished
            console.log(this.published, this.finished)

            this.loadFormQuestions()
        },

        computed: {
            editTitle() {
                return 'Редактирование опроса #' + this.form.id
            },

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
            onMainInfoChanged(info) {
                this.title = info.title
                this.description = info.description
                this.published = info.published
                this.finished = info.finished
            },

            addQuestion(question) {
                this.questions.push(question)
            },

            updateQuestion(question) {
                this.questions[question.index] = question
            },

            deleteQuestion(index) {
                if (!confirm('Вопрос и его варианты ответа будут удалены. Вы уверены?')) {
                    return;
                }

                if (this.questions[index].id === undefined) {
                    this.questions.splice(index, 1)
                    return;
                }

                let _self = this;
                let _payload = {
                    form_id: this.form.id,
                    question_id: this.questions[index].id,
                }

                axios.post(this.deleteQuestionUrl, _payload).then(function (response) {
                    let responseData = response.data
                    console.log(responseData)

                    if (responseData.success === true) {
                        if (responseData.messages !== undefined) {
                            $.each(responseData.messages, function (key, value) {
                                toastr.success(value, 'Уведомление')
                            });
                        }

                        _self.questions.splice(index, 1)
                    } else {
                        if (responseData.errors !== undefined) {
                            // error callback
                            $.each(responseData.errors, function (key, value) {
                                toastr.error(value, 'Ошибка')
                            });
                        } else {
                            toastr.error('Что-то пошло не так. Обратитесь к администратору.', 'Ошибка')
                        }
                    }
                }).catch(function (error) {
                    console.log(error)
                    let data = error.response.data
                    console.log(data)

                    if (data.errors !== undefined) {
                        $.each(data.errors, function (key, value) {
                            toastr.error(value, 'Ошибка')
                        });
                    } else if (data.messages !== undefined) {
                        $.each(data.messages, function (key, value) {
                            toastr.error(value, 'Ошибка')
                        });
                    } else {
                        toastr.error('Что-то пошло не так. Обратитесь к администратору.', 'Ошибка')
                    }
                })
            },

            editQuestion(index) {
                this.editQuestionIndex = index
                this.isQuestionEdit = true
            },

            loadFormQuestions() {
                let _questions = this.form.questions

                for (let i = 0; i < _questions.length; i++) {
                    let _question = _questions[i]

                    this.questions.push({
                        id: _question.id,
                        title: _question.title,
                        is_required: _question.is_required,
                        selectedAnswerType: _question.answer_type.type,
                        answers: $.map(_question.answers, function (answer, index) {
                            return {id: answer.id, title: answer.title}
                        })
                    })
                }
            },

            updateForm() {
                if (!this.isFormValid()) {
                    return;
                }

                let _payload = {
                    id: this.id,
                    title: this.title,
                    description: this.description,
                    questions: this.questions,
                    is_published: this.published,
                    is_finished: this.finished
                }

                axios.post(this.updateUrl, _payload).then(function (response) {
                    let data = response.data
                    console.log(data)

                    if (data.success === true) {
                        if (data.messages !== undefined) {
                            $.each(data.messages, function (key, value) {
                                toastr.success(value, 'Уведомление')
                            });
                        }
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        if (data.errors !== undefined) {
                            // error callback
                            $.each(data.errors, function (key, value) {
                                toastr.error(value, 'Ошибка')
                            });
                        } else {
                            toastr.error('Что-то пошло не так. Обратитесь к администратору.', 'Ошибка')
                        }
                    }
                }).catch(function (error) {
                    let data = error.response.data
                    console.log(data)

                    if (data.errors !== undefined) {
                        $.each(data.errors, function (key, value) {
                            toastr.error(value, 'Ошибка')
                        });
                    } else if (data.messages !== undefined) {
                        $.each(data.messages, function (key, value) {
                            toastr.error(value, 'Ошибка')
                        });
                    } else {
                        toastr.error('Что-то пошло не так. Обратитесь к администратору.', 'Ошибка')
                    }
                })
            },

            isFormValid() {
                return true; // TODO
            }
        },

        components: {
            'draggable': draggable,
            'add-or-edit-question': AddOrEditQuestionComponent,
            'add-main-information': AddMainInformationComponent
        }
    }
</script>
