<template>
    <div>
        {{ answers.length }}
    </div>
</template>

<script>
    export default {
        props: ['formAnswers'],

        data() {
            return {
                answers: []
            }
        },

        mounted() {
            this.answers = this.formAnswers
        }
    }
</script>