<template>

    <div role="dialog">

        <!-- Anchor -->
        <div ref="anchorElem" class="dialog-anchor">
            <slot name="dialog-anchor"></slot>
        </div>

        <!-- Dialog -->
        <div ref="dialogOverlayElem"  class="dialog-overlay"
        >
            <div ref="dialogContentElem"
                 class="dialog-content">
                <slot name="dialog-content"></slot>
            </div>
        </div>

    </div>

</template>

<style scoped>
    .dialog-anchor{
        display: inline-block;
        width: 100%;
    }
</style>

<script setup>

    import {onMounted, ref} from "vue";

    const anchorElem = ref(null);
    const dialogOverlayElem = ref(null);
    const dialogContentElem = ref(null);
    const originalBodyOverflow = ref(null);
    defineExpose({
        openDialog,
        closeDialog
    })

    onMounted(() => {

        originalBodyOverflow.value = dialogOverlayElem.value.style.overflow;

        // open dialog on anchor click
        anchorElem.value.addEventListener('click',  function(evt){
            let clickedElem = evt.target;
            if(!clickedElem.classList.contains('dontOpenDialog') &&
                clickedElem.closest('.dontOpenDialog') == null){
                openDialog();
            }
        });

        // close dialog on click outside dialog
        dialogOverlayElem.value.addEventListener('click', function(evt){
            let clickedElem = evt.target;
            if(clickedElem.closest('.dialog-content') == null){
                closeDialog();
            }
        });

        // close dialog on role=closeDialog elements click
        dialogContentElem.value.querySelectorAll('[role="closeDialog"]')
            .forEach(function (item) {
                item.addEventListener('click', closeDialog);
            });

    });

    function openDialog(){
        document.querySelector('body').style.overflow = 'hidden';
        dialogOverlayElem.value.classList.add('visible');
        dialogContentElem.value.classList.add('visible');
    }

    function closeDialog(){
        document.querySelector('body').style.overflow = originalBodyOverflow.value;
        dialogContentElem.value.classList.remove('visible');
        dialogOverlayElem.value.classList.remove('visible');
    }

</script>
