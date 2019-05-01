<template>
    <div>
        <div v-if="isAddQuestionBtnClicked" id="add-new-form-question">
            <div class="ln_solid"></div>
            <button @click="isAddQuestionBtnClicked = false" type="button"
                    class="btn btn-sm btn-danger">Отмена
            </button>
            <button type="button" class="btn btn-sm btn-success">Добавить</button>
        </div>
        <button v-else @click="isAddQuestionBtnClicked = true" type="button"
                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isAddQuestionBtnClicked: false
            }
        }
    }
</script>