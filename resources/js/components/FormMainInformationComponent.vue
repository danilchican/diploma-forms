<template>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Основная информация об опросе</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-2">
                                <label for="form-title">Название опроса: <span class="required">*</span></label>
                                <input v-model="title" id="form-title" placeholder="Введите название опроса"
                                       class="form-control" required="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-2">
                                <label for="form-description">Описание опроса:</label>
                                <textarea v-model="description" id="form-description"
                                          placeholder="Заполните описание опроса"
                                          rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
                description: ''
            }
        },

        watch: {
            title() {
                this.$emit('infoChanged', this.getInfo());
            },
            description() {
                this.$emit('infoChanged', this.getInfo());
            }
        },

        methods: {
            getInfo() {
                return {
                    title: this.title,
                    description: this.description
                }
            }
        }
    }
</script>