<template>
    <div v-if="rendered">
        <p v-if="index === 1" style="margin: 0;">Добавьте первый вопрос.</p>
        <div v-if="isAddQuestionBtnClicked || isQuestionEdit" id="add-new-form-question">
            <div class="ln_solid"></div>
            <div class="row">
                <!--TODO onsubmit-->
                <form class="form-horizontal form-label-left" onsubmit="return false;">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="form-title">Название вопроса: <span class="required">*</span></label>
                            <input v-model="question.title" id="form-title" placeholder="Введите название опроса"
                                   class="form-control" required="required"/>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="form-answer-type">Тип ответа: <span class="required">*</span></label>
                            <select v-model="question.selectedAnswerType" id="form-answer-type"
                                    class="form-control" required="required">
                                <option v-for="answerType in answerTypes" :value="answerType.type">
                                    {{ answerType.title}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label>Обязательный вопрос: <span class="required">*</span>
                                <input type="checkbox" v-model="question.is_required" required="required"/>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" v-if="answerTypeNeedsAnswerVariants">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="question-answer-variants">
                                Варианты ответов: <span class="required">*</span>
                            </label>
                            <div v-if="question.answers.length > 0" id="question-answer-variants">
                                <div v-for="(answer, index) in question.answers">
                                    <view-answer-variant :answerType="findAnswerTypeByType(question.selectedAnswerType)"
                                                         :answer="answer" :index="index"
                                                         @onAnswerChanged="updateAnswer"
                                                         @onAnswerDeleted="deleteAnswer"/>
                                </div>
                            </div>
                            <p v-else>Добавьте хотя бы один ответ на вопрос.</p>
                            <button @click="addAnswer" type="button" class="btn btn-xs btn-primary">
                                <i class="fa fa-plus"></i> Добавить ответ
                            </button>
                        </div>
                    </div>
                    <div class="form-group" v-else>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" v-model="textAnswerValuePlaceholder"
                                   style="opacity: 0.8;" readonly/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ln_solid"></div>
            <button @click="declineAddOrEditQuestion" type="button" class="btn btn-sm btn-danger">Отмена</button>
            <button @click="saveQuestion" type="button" class="btn btn-sm btn-success">Сохранить вопрос</button>
        </div>
        <button v-else @click="addQuestion" type="button" style="margin-top: 10px;"
                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
    </div>
</template>

<script>
    import ViewAnswerVariant from './ViewAnswerVariantComponent.vue'

    export default {
        props: [
            'index', 'answerTypes', 'isQuestionEdit', 'editQuestionIndex',
            'deleteAnswerVariantUrl'
        ],

        data() {
            return {
                rendered: true,
                isAddQuestionBtnClicked: false,
                question: {
                    title: 'Вопрос без заголовка ' + this.index,
                    is_required: true,
                    selectedAnswerType: 'radio',
                    answers: []
                }
            }
        },

        watch: {
            isQuestionEdit() {
                if (this.isQuestionEdit) {
                    let _question = this.$parent.questions[this.editQuestionIndex]
                    this.question = JSON.parse(JSON.stringify(_question))
                } else {
                    this.cleanQuestionForm()
                }
            },

            index() {
                this.question.title = 'Вопрос без заголовка ' + this.index
            }
        },

        computed: {

            answerTypeNeedsAnswerVariants() {
                let _answerType = this.findAnswerTypeByType(this.question.selectedAnswerType)
                return (_answerType instanceof Object) ? _answerType.answers_required : false
            },

            textAnswerValuePlaceholder() {
                return this.question.selectedAnswerType === 'text' ? 'Краткий ответ' : 'Развернутый ответ'
            }
        },

        methods: {
            toggleAddQuestionBtn(value) {
                this.isAddQuestionBtnClicked = value
            },

            addQuestion() {
                this.question.answers.push({title: 'Вариант 1'})
                this.toggleAddQuestionBtn(true)
            },

            addAnswer() {
                this.question.answers.push({title: 'Вариант ' + (this.question.answers.length + 1)})
            },

            declineAddOrEditQuestion() {
                this.cleanQuestionForm()
                this.toggleAddQuestionBtn(false)
            },

            saveQuestion() {
                if (this.isQuestionEdit) {
                    this.$emit('questionUpdated', JSON.parse(JSON.stringify(this.getEditableQuestionInfo())))
                } else {
                    this.$emit('questionCreated', JSON.parse(JSON.stringify(this.getQuestionInfo())))
                }

                this.cleanQuestionForm()
                this.toggleAddQuestionBtn(false)
            },

            deleteAnswer(index) {
                if (!confirm('Ответ на вопрос будет удален. Вы уверены, что хотите продолжить?')) {
                    return;
                }

                if (this.question.answers[index].id === undefined) {
                    this.question.answers.splice(index, 1)

                    this.rendered = false
                    this.$nextTick(() => {
                        // Add the component back in
                        this.rendered = true
                    });
                } else {
                    let _self = this;
                    let _payload = {id: this.question.answers[index].id}

                    axios.post(this.deleteAnswerVariantUrl, _payload).then(function (response) {
                        let responseData = response.data
                        console.log(responseData)

                        if (responseData.success === true) {
                            if (responseData.messages !== undefined) {
                                $.each(responseData.messages, function (key, value) {
                                    toastr.success(value, 'Уведомление')
                                });
                            }

                            _self.question.answers.splice(index, 1)

                            _self.rendered = false
                            _self.$nextTick(() => {
                                // Add the component back in
                                _self.rendered = true
                            });
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
                }
            },

            updateAnswer(answer) {
                this.question.answers[answer.index] = {title: answer.title};
            },

            findAnswerTypeByType(type) {
                return this.answerTypes.filter(v => v.type === type)[0]
            },

            getEditableQuestionInfo() {
                let _answersRequired = this.findAnswerTypeByType(this.question.selectedAnswerType).answers_required;

                return {
                    index: this.editQuestionIndex,
                    id: this.question.id,
                    title: this.question.title,
                    is_required: this.question.is_required,
                    selectedAnswerType: this.question.selectedAnswerType,
                    answers: _answersRequired ? this.question.answers : []
                }
            },

            getQuestionInfo() {
                let _answersRequired = this.findAnswerTypeByType(this.question.selectedAnswerType).answers_required;

                return {
                    title: this.question.title,
                    is_required: this.question.is_required,
                    selectedAnswerType: this.question.selectedAnswerType,
                    answers: _answersRequired ? this.question.answers : []
                }
            },

            cleanQuestionForm() {
                this.$parent.isQuestionEdit = false
                this.$parent.editQuestionIndex = null

                this.question.is_required = true
                this.question.selectedAnswerType = 'radio'
                this.question.answers = []
            }
        },

        components: {
            'view-answer-variant': ViewAnswerVariant
        }
    }
</script>