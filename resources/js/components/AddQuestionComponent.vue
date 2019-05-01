<template>
    <div>
        <div v-if="isAddQuestionBtnClicked" id="add-new-form-question">
            <div class="ln_solid"></div>
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
                question: {}
            }
        },

        methods: {
            toggleAddQuestionBtn() {
                this.isAddQuestionBtnClicked = !this.isAddQuestionBtnClicked;
            },

            addQuestion() {
                this.$emit('questionCreated', this.question);
                this.toggleAddQuestionBtn();
                this.cleanQuestionForm();
            },

            cleanQuestionForm() {
                this.question = {}; // TODO
            }
        }
    }
</script>