<template>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Основная информация</h2>
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

                        <div class="form-group">
                            <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-2">
                                <label>Опубликован: <span class="required">*</span>&nbsp;</label>
                                <div id="published" class="btn-group" data-toggle="buttons">
                                    <label @click="updatePublished(true)" class="btn btn-default"
                                           :class="['btn btn-default', published ? ' active' : '']"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="published" value="true">
                                        Да
                                    </label>
                                    <label @click="updatePublished(false)" id="publish-default"
                                           :class="['btn btn-default', !published ? ' active' : '']"
                                           class="btn btn-primary active"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="published" value="false">
                                        Нет
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" v-if="isEditForm">
                            <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-2">
                                <label>Завершен: <span class="required">*</span>&nbsp;</label>
                                <div id="finished" class="btn-group" data-toggle="buttons">
                                    <label @click="updateFinished(true)" class="btn btn-default"
                                           :class="['btn btn-default', finished ? ' active' : '']"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="finished" value="true">
                                        Да
                                    </label>
                                    <label @click="updateFinished(false)" id="finished-default"
                                           :class="['btn btn-default', !finished ? ' active' : '']"
                                           class="btn btn-primary active"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="finished" value="false">
                                        Нет
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" v-if="isEditForm">
                            <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-2">
                                <label>Выгрузка результатов: <span class="required">*</span>&nbsp;</label>
                                <div id="can-download-results" class="btn-group" data-toggle="buttons">
                                    <label @click="updateDownloadResultsAvailability(true)" class="btn btn-default"
                                           :class="['btn btn-default', can_download_results ? ' active' : '']"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="can_download_results" value="true">
                                        Да
                                    </label>
                                    <label @click="updateDownloadResultsAvailability(false)"
                                           id="can-download-results-default"
                                           :class="['btn btn-default', !can_download_results ? ' active' : '']"
                                           class="btn btn-primary active"
                                           data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="can_download_results" value="false">
                                        Нет
                                    </label>
                                </div>
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
        props: {
            editTitle: String,
            editDescription: String,
            editPublished: Boolean,
            editFinished: Boolean,
            editCanDownloadResults: Boolean,
            isEditForm: Boolean
        },

        data() {
            return {
                title: '',
                description: '',
                published: false,
                finished: false,
                can_download_results: false
            }
        },

        mounted() {
            this.title = this.editTitle;
            this.description = this.editDescription;
            this.published = this.editPublished;
            this.finished = this.editFinished;
            this.can_download_results = this.editCanDownloadResults;
        },

        watch: {
            title() {
                this.$emit('infoChanged', this.getInfo());
            },
            description() {
                this.$emit('infoChanged', this.getInfo());
            },
            published() {
                this.$emit('infoChanged', this.getInfo());
            },
            finished() {
                this.$emit('infoChanged', this.getInfo());
            },
            can_download_results() {
                this.$emit('infoChanged', this.getInfo());
            },
            editTitle() {
                this.title = this.editTitle
            },
            editDescription() {
                this.description = this.editDescription
            },
            editPublished() {
                this.published = this.editPublished
            },
            editFinished() {
                this.finished = this.editFinished
            },
            editCanDownloadResults() {
                this.can_download_results = this.editCanDownloadResults
            }
        },

        methods: {
            getInfo() {
                return {
                    title: this.title,
                    description: this.description,
                    published: this.published,
                    finished: this.finished,
                    can_download_results: this.can_download_results
                }
            },

            updatePublished(value) {
                this.published = Boolean(value);
            },

            updateFinished(value) {
                this.finished = Boolean(value);
            },

            updateDownloadResultsAvailability(value) {
                this.can_download_results = Boolean(value);
            },
        }
    }
</script>