<template>

    <div class="file_card">

        <div class="info">

            <!-- thumbnail -->
            <div class="preview">

                <img v-if="item.thumbnail_exists" :src=thumbnail_url />
                <div v-else-if="item.document_type==='video' && item.youtube_thumbnail_url!==null">
                    <img :src=item.youtube_thumbnail_url />
                </div>
                <i v-else :class="'icon-svg icon-'+file_icon"></i>
            </div>

            <!-- content -->
            <div class="content">
                <div>
                    <div class="title">{{ item.title }}</div>
                    <div class="author" v-if="item.author!==null">{{ item.author }}</div>
                    <div class="abstract">{{ abstract_truncated }}</div>
                    <div class="links">
<!--                        <button class="btn-nav  rounded read_more_anchor" data-toggle="modal" :data-target="'#read-more_modal_'+item.hash">{{ labels.read_more }}</button>-->
                    </div>
                </div>
            </div>

        </div>

        <!-- file attributes -->
        <div class="file_attributes">

            <div class="file_attribute" v-if="item.date!==null">
                <span class="file_attribute_label">{{ labels.date }}:</span>
                {{ item.date }}
            </div>
            <div class="file_attribute" v-if="item.source!==null">
                <span class="file_attribute_label">{{ labels.source }}:</span>
                {{ item.source }}
            </div>
            <div class="file_attribute" v-if="item.file_size!==null">
                <span class="file_attribute_label">{{ labels.size }}: </span>
                {{ item.file_size }}
            </div>

            <div class="links">
                <a v-if="item.downloadable!==false && item.document_type!=='video'"
                   :href=item.url target="_blank"
                   class="btn-nav">
                    <i class="fas fa-cloud-download-alt" aria-hidden="true"></i>
                    {{ labels.download }}
                </a>
                <a v-else-if="item.document_type==='video'"
                   :href=item.url target="_blank"
                   class="btn-nav">
                    <span class="fas fa-fw fa-play-circle"></span>
                    {{ labels.play }}
                </a>
                <a v-else-if="item.downloadable===false"
                   class="btn-nav disabled">
                    <span class="fa fa-fw fa-lock"></span>
                    {{ labels.confidential }}
                </a>
                <a v-if="item.downloadable!==false"
                   @click="Common.copyToClipboard(item.url, Locale.getLabel('common.copied_link'))"
                   class="btn-nav green-dark">
                    <span class="fa fa-fw fa-copy"></span>
                    {{ Locale.getLabel('common.copy_link') }}
                </a>
            </div>
        </div>

    </div>

</template>

<script>

    import Common from '../../utils/common.js';

    export default {

        data: function () {
            return {
                Locale: window.Locale,
                Common: Common,
            }
        },

        props: {

            item : {
                type: Object,
                default: () => {}
            },
            labels: {
                type: Object,
                default: () => {
                    return {
                        close: Locale.getLabel('common.close'),
                        download: Locale.getLabel('common.download'),
                        play: Locale.getLabel('common.play'),
                        confidential: Locale.getLabel('common.confidential'),
                        read_more: Locale.getLabel('common.publication.read_more'),
                        date: Locale.getLabel('form/catalogue.Document.fields.date'),
                        abstract: Locale.getLabel('form/catalogue.Document.fields.abstract'),
                        author: Locale.getLabel('form/catalogue.Document.fields.author'),
                        source: Locale.getLabel('form/catalogue.Document.fields.source'),
                        language: Locale.getLabel('form/catalogue.Document.fields.language'),
                        official: Locale.getLabel('form/catalogue.Document.fields.official'),
                        yes: Locale.getLabel('common.yes'),
                        no: Locale.getLabel('common.no'),
                        localisation: Locale.getLabel('form/catalogue.Location.title'),
                        size: Locale.getLabel('form/catalogue.Document.fields.size'),
                    }
                }
            },
            abstract_length: {
                type: Number,
                default: 800
            }
        },

        computed: {
            thumbnail_url(){
                return Laravel.baseUrl + 'thumbnail/' + this.item.hash;
            },
            abstract_truncated(){
                let abstract = this.item.abstract;
                if(abstract!==null){
                    return abstract.length <= this.abstract_length ? abstract : abstract.substring(0, this.abstract_length)+' ...';
                }
                return '';
            },
            file_icon(){
                let type = this.item.document_type;
                let icon = '';
                if(type==='video'){
                    icon = 'multimedia';
                } else if(type==='presentation'){
                    icon = 'presentation';
                } else if(type==='dataset'){
                    icon = 'spreadsheet';
                } else if(type==='map'){
                    icon = 'map-location';
                } else {
                    icon = 'theme';
                }
                return icon;
            }
        }
    }
</script>

<style lang="scss" type="text/scss" scoped>

    @import "../../../sass/abstracts/all";

    .file_card{
        display: flex;
        flex-direction: column;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid $darkGreen;
        &:last-of-type{
            border-bottom: 0;
            padding-bottom: 0;
            margin-bottom: 0;
        }
        >.info{
            display: flex;
            flex-direction: row;
            >.preview{
                width: 130px;
                min-width: 130px;
                text-align: center;
                i.icon-svg{
                    width: 60px;
                    height: 60px;
                    margin-top: 60px;
                    &:before{
                        background-color: $darkestGray;
                    }
                }
            }
            >.content{
                padding: 0 0 0 15px;
                >div{
                    width: 100%;
                    &:first-child{
                        padding: 0 0 0 0;
                        .title{
                            @include text-lg;
                            color: $baseGreen;
                            margin-bottom: 10px;
                        }
                        .author{
                            @include text-xs;
                        }
                        .abstract{
                            @include text-sm;
                            line-height: 1.3em !important;
                            margin: 10px 0;
                        }
                        .links{
                            margin-top: 15px;
                        }
                    };
                }
            }

        }
        .file_attributes{
            background-color: $lightestGray;
            padding: 15px;
            margin-top: 15px;
            @include text-xs;
            display: grid;
            grid-template-columns: repeat(3, auto);
            >div{
                &.file_attribute {
                    text-align: center;
                    .file_attribute_label {
                        font-weight: bold;
                        margin-right: 3px;
                    }
                }
                &.links{
                    grid-column-start: 1;
                    grid-column-end: 4;
                    width: 100%;
                    border-top:1px solid $baseGreen;
                    padding-top: 10px;
                    margin-top: 10px;
                    a{
                        margin-bottom: 0;
                        cursor: pointer;
                    }
                }
            }
        }

    }

</style>