<template>
    <div>
        <div v-if="isType('select')">
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon">{{ index + 1 }}.</span>
                <input type="text" class="form-control" v-model="answer.title" placeholder="Введите вариант ответа"/>
                <span class="input-group-addon" v-if="index !== 0">
                    <button type="button" class="btn btn-xs btn-danger" style="margin: 0;"
                            @click="deleteAnswer">
                        <span class="fa fa-close"></span>
                    </button>
                </span>
            </div>
        </div>
        <div v-else>
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon">
                    <input :type="answerType.type" disabled="disabled"/> <span>{{ index + 1 }}.</span>
                </span>
                <input type="text" class="form-control" v-model="innerAnswer.title" placeholder="Введите вариант ответа"/>
                <span class="input-group-addon" v-if="index !== 0">
                    <button type="button" class="btn btn-xs btn-danger" style="margin: 0;"
                            @click="deleteAnswer">
                        <span class="fa fa-close"></span>
                    </button>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['index', 'answer', 'answerType'],

        data() {
            return {
                innerAnswer: this.answer
            }
        },

        watch: {
            innerAnswer() {
                let _obj = {
                    index: this.index,
                    title: this.innerAnswer
                }

                if(this.innerAnswer.id !== undefined) {
                    _obj.id = this.innerAnswer.id;
                }

                this.$emit('onAnswerChanged', _obj);
            }
        },

        methods: {
            isType(typeName) {
                return this.answerType.type === typeName
            },

            deleteAnswer() {
                this.$emit('onAnswerDeleted', this.index)
            }
        }
    }
</script>