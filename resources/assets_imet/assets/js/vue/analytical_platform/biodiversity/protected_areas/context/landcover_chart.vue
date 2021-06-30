<template>

    <div v-if="serie_pressure!==null">
        <div id="chart" class="card-chart"></div>
    </div>

</template>

<style lang="scss" type="text/scss" scoped>
</style>

<script>
    export default {
        props: {
            serie_pressure: {
                type: [Array,Object],
                default: () => null
            },
        },

        mounted() {
                if (this.serie_pressure!== null){
                this.thread_pressure(this.serie_pressure);
            } else {
            }
        },

        methods: {
            thread_pressure( serie_pressure){
                var formatUtil = echarts.format;
                echarts
                        .init(document.getElementById('chart'))
                        .setOption({
                                toolbox: {
                                    feature: {
                                        saveAsImage: {
                                            title:'save',
                                            type:'png',
                                            name:'LandCover Change',
                                            show:true
                                        }
                                    }
                                },
                                 tooltip:{
                                     formatter: function (info) {
                                        var value = info.value;
                                        var treePathInfo = info.treePathInfo;
                                        var treePath = [];

                                        for (var i = 1; i < treePathInfo.length; i++) {
                                            treePath.push(treePathInfo[i].name);
                                        }

                                        return [
                                            '<div class="tooltip-title">' + formatUtil.encodeHTML(treePath.join('/')) + '</div>',
                                            'Value: ' + formatUtil.addCommas(value),
                                        ].join('');
                                    }
                                 },
                                 series: serie_pressure
                        });

        }

        }
    }
</script>
