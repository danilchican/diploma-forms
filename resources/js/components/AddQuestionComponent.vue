<template>
    <div>
        <div class="ln_solid"></div>
        <div v-if="isAddQuestionBtnClicked" id="add-new-form-question">
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
                                    @change="onAnswerTypeChange"
                                    class="form-control" required="required">
                                <option v-for="answerType in answerTypes" :value="answerType.type">
                                    {{ answerType.title}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" v-if="answerTypeNeedsAnswerVariants">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="question-answer-variants">
                                Варианты ответов: <span class="required">*</span>
                            </label>
                            <div id="question-answer-variants">
                                <div v-for="(answer, index) in question.answers">
                                    <view-answer-variant :index="index + 1" :answer="answer"
                                                         :answerType="findAnswerTypeByType(question.selectedAnswerType)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <button @click="toggleAddQuestionBtn" type="button" class="btn btn-sm btn-danger">Отмена</button>
            <button @click="saveQuestion" type="button" class="btn btn-sm btn-success">Сохранить вопрос</button>
        </div>
        <button v-else @click="addQuestion" type="button"
                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
    </div>
</template>

<script>
    import ViewAnswerVariant from './ViewAnswerVariantComponent.vue'

    export default {
        props: ['answerTypes'],

        data() {
            return {
                isAddQuestionBtnClicked: false,
                question: {
                    title: '',
                    selectedAnswerType: 'radio',
                    answers: []
                }
            }
        },

        computed: {
            answerTypeNeedsAnswerVariants() {
                let _answerType = this.findAnswerTypeByType(this.question.selectedAnswerType)
                return (_answerType instanceof Object) ? _answerType.answers_required : false;
            }
        },

        methods: {
            toggleAddQuestionBtn() {
                this.isAddQuestionBtnClicked = !this.isAddQuestionBtnClicked
            },

            addQuestion() {
                this.question.answers.push('Вариант 1');
                this.question.answers.push('Вариант 2');
                this.toggleAddQuestionBtn()
            },

            saveQuestion() {
                this.$emit('questionCreated', JSON.parse(JSON.stringify(this.question)))
                this.cleanQuestionForm()
                this.toggleAddQuestionBtn()
            },

            onAnswerTypeChange(event) {
                // console.log(event);
            },

            findAnswerTypeByType(type) {
                return this.answerTypes.filter(v => v.type === type)[0]
            },

            cleanQuestionForm() { // TODO
                this.question.title = ''
                this.question.selectedAnswerType = 'radio'
                this.question.answers = []
            }
        },

        components: {
            'view-answer-variant': ViewAnswerVariant
        }
    }
</script>