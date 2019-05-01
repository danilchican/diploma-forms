<template>
    <div>
        <div v-if="isType('select')">
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon">{{ index }}.</span>
                <input type="text" class="form-control" v-model="answer" placeholder="Введите вариант ответа"/>
            </div>
        </div>
        <div v-else>
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon">
                    <input :type="answerType.type" class="flat" disabled="disabled"/> <span>{{ index }}.</span>
                </span>
                <input type="text" class="form-control" v-model="answer" placeholder="Введите вариант ответа"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['index', 'answer', 'answerType'],

        methods: {
            isType(typeName) {
                return this.answerType.type === typeName
            }
        }
    }
</script>