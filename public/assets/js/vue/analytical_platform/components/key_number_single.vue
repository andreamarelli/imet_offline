<template>

    <div>
        <div class="list-key-numbers">
            <div>
                <i v-if="icon!==''" :class="'icon-svg icon-'+icon" />
                <div class="content">
                    <span class="txt">{{ label }}{{ year!==null ? ' (' + year + ')' : '' }}</span>
                    <span class="number">{{ absolute | pretty_number }} <span v-html=unit_label /></span>
                </div>
                <gauge v-if="percentage!=null" :percentage=percentage />
            </div>
        </div>
    </div>

</template>

<script>
    
    import base from './_base.mixin';
    export default {
        mixins: [
            base,
        ],
        props: {
            label : {
                type: String,
                default: ''
            },
            year : {
                type: [String, Number],
                default: null
            },
            icon : {
                type: String,
                default: ''
            },
            absolute : {
                type: [String, Number],
                default: null
            },
            percentage : {
                type: [String, Number],
                default: null
            },
            unit: {
                type: String,
                default: ''
            },
        },

        computed: {
            unit_label () {
                if(this.unit.toLowerCase()==='m3'){
                    return 'm<sup>3</sup>'
                }
                else if(this.unit.toLowerCase()==='km2'){
                    return 'km<sup>2</sup>'
                }
                else if(this.unit.toLowerCase()==='ha'){
                    return 'ha'
                }
                else if(this.unit.toLowerCase()==='usd'){
                    return '&#36;'
                }
                else if(this.unit.toLowerCase()==='euro'){
                    return '&euro;'
                }
                return '';
            }
        },

        beforeMount() {
            
        }
    }
</script>




