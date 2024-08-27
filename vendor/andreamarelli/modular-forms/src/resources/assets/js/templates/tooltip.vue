<template>

    <div ref="tooltipElem" role="tooltip">
        <div class="tooltip-content">
            <slot></slot>
        </div>
        <div ref="arrowElem" class="tooltip-arrow"></div>
    </div>

</template>

<style lang="scss" scoped>

    [role=tooltip] {
        display: none;
        width: max-content;
        position: absolute;
        top: 0;
        left: 0;

        .tooltip-arrow {
            position: absolute;
            width: 8px;
            height: 8px;
            transform: rotate(45deg);
        }

    }

</style>

<script>

import {ref, reactive, onMounted} from "vue";
import {computePosition, autoUpdate, flip, shift, offset, arrow} from "~/@floating-ui/dom";

export default {

    props: {
        anchorElemId: {
            type: String,
            default: null
        },
        onClick: {
            type: Boolean,
            default: false
        },
    },


    setup(props) {

        const tooltipElem = ref(null);
        const arrowElem = ref(null);
        const anchorElem = ref(null);

        const state = reactive({
            isVisible: false,
        });


        onMounted(() => {

            anchorElem.value =  props.anchorElemId!==null
                ? document.querySelector('#' + props.anchorElemId)
                : tooltipElem.value.previousElementSibling;

            // set event listeners
            if(props.onClick){
                enableClickListeners();
            } else {
                enableHoverListeners();
            }

        });
        /**
         * set event listener to toggle tooltip
         */
        const enableHoverListeners = () => {
            [
                ['mouseenter', showTooltip],
                ['mouseleave', hideTooltip],
                ['focus', hideTooltip],
                ['blur', hideTooltip],
            ].forEach(([event, listener]) => {
                anchorElem.value.addEventListener(event, listener);
            });
        };

        const enableClickListeners = () => {

            // toggle on anchor click
            anchorElem.value.addEventListener('click', toggleTooltip);
            // close on click outside tooltip
            document.addEventListener('click', function(evt){
                if(state.isVisible) {
                    let clickedElem = evt.target;
                    if (clickedElem.closest('[role=tooltip]') == null
                        && clickedElem.closest('#'+props.anchorElemId) == null) {
                        hideTooltip();
                    }
                }
            });
        };


        /**
         * Initialize FloatingUI tooltip
         */
        const setTooltipPosition = () => {

            autoUpdate(anchorElem.value, tooltipElem.value, () => {

                if(anchorElem.value !== null && arrowElem.value !==null){

                    const arrowWidth = arrowElem.value.offsetWidth;
                    const floatingOffset = Math.sqrt(2 * arrowWidth ** 2) / 2;

                    computePosition(anchorElem.value, tooltipElem.value, {
                        placement: 'top',
                        middleware: [
                            flip(),
                            shift({
                                padding: 5
                            }),
                            offset({
                                mainAxis: floatingOffset,
                            }),
                            arrow({element: arrowElem.value})
                        ],
                    })
                    .then(({x, y, placement, middlewareData}) => {

                        // Assign position to tooltip
                        Object.assign(tooltipElem.value.style, {
                            left: `${x}px`,
                            top: `${y}px`,
                        });

                        // Assign position to arrow
                        if (middlewareData.arrow) {
                            const { x, y } = middlewareData.arrow;
                            const staticSide = {
                                top: 'bottom',
                                right: 'left',
                                bottom: 'top',
                                left: 'right',
                            }[placement.split('-')[0]];
                            Object.assign(arrowElem.value.style, {
                                left: x != null ? `${x}px` : '',
                                top: y != null ? `${y}px` : '',
                                right: '',
                                bottom: '',
                                [staticSide]: `${-arrowElem.value.offsetWidth / 2}px`,
                            });
                        }

                    });

                }

            });

        };

        const toggleTooltip = () => {
            if(state.isVisible){
                hideTooltip();
            } else{
                showTooltip();
            }
        };

        /**
         * Show tooltip
         */
        const showTooltip = () => {
            if(!state.isVisible) {
                let content = tooltipElem.value.querySelector('.tooltip-content').textContent.trim();
                if (content !== '') {
                    tooltipElem.value.style.display = 'block';
                    setTooltipPosition();
                    state.isVisible = true;
                    if(!props.onClick){
                        setTimeout(function () {
                            hideTooltip();
                        }, 10000);
                    }
                }
            }
        };

        /**
         * Hide tooltip
         */
        const hideTooltip = () => {
            if(state.isVisible){
                tooltipElem.value.style.display = '';
                state.isVisible = false;
            }
        };

        return {
            tooltipElem,
            arrowElem,
            // state
        }

    },

}
</script>
