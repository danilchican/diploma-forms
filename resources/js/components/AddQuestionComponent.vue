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
                            <select id="form-answer-type" class="form-control" required="required">
                                <!--TODO populate data-->
                                <option value="0" selected disabled>Выберите тип ответа...</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <button @click="toggleAddQuestionBtn" type="button" class="btn btn-sm btn-danger">Отмена</button>
            <button @click="addQuestion" type="button" class="btn btn-sm btn-success">Добавить</button>
        </div>
        <button v-else @click="toggleAddQuestionBtn" type="button"
                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isAddQuestionBtnClicked: false,
                question: {
                    title: '',
                }
            }
        },

        methods: {
            toggleAddQuestionBtn() {
                this.isAddQuestionBtnClicked = !this.isAddQuestionBtnClicked
            },

            addQuestion() {
                this.$emit('questionCreated', JSON.parse(JSON.stringify(this.question)))
                this.toggleAddQuestionBtn()
                this.cleanQuestionForm()
            },

            cleanQuestionForm() { // TODO
                this.question.title = ''
            }
        }
    }
</script>