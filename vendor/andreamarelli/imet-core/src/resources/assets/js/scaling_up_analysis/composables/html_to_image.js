import {ref, onMounted} from 'vue';
import * as htmlToImage from '~/html-to-image';

export function useHtmlToImage(props, emit) {
    const randomElement = ref('');

    function createRandomElement() {
        if (!props.element) {
            randomElement.value = `elem_${Math.floor(Math.random() * 1000)}`;
        } else {
            randomElement.value = props.element;
        }
    }

    function showEditor(element) {
        const block = element.querySelectorAll('.text-editor-edit');
        block.forEach(i => i.style.display = 'block');
        const none = element.querySelectorAll('.text-editor-print');
        none.forEach(i => i.style.display = 'none');
    }

    function hideEditor(element) {
        const block = element.querySelectorAll('.text-editor-edit');
        block.forEach(i => i.style.display = 'none');
        const none = element.querySelectorAll('.text-editor-print');
        none.forEach(i => {
            if (i.innerText.length > 0) {
                i.style.display = 'block';
            }
        });
    }

    async function htmlToImageFunc(func, attr, size = 1024) {
        const element = document.getElementById(randomElement.value);
        element.classList.add('bg-white');
        showHideExcludedElements();
        hideEditor(element);

        htmlToImage.toPng(element, {
            canvasWidth: element.clientWidth ?? size,
            filter: (node) => {
                const classNames = node?.className;
                const id = node?.id;
                if (typeof classNames !== 'string') {
                    return true;
                }
                const exclude = ['add_item', 'carrot', 'generic-comments', 'exclude-element', 'dropzone-areas', 'js-smallMenu', 'guidance'];

                return !exclude.some(val => classNames.includes(val));
            }
        })
            .then(async function (dataUrl) {
                func(dataUrl, attr);
            }).catch((error) => {
            console.error(error);
        }).finally(() => {
            showEditor(element);
            showHideExcludedElements('block');
        });
    }

    function showHideExcludedElements(action = 'none') {
        if (props.exclude_elements.length > 0) {
            const excludeElements = props.exclude_elements.split(',');

            excludeElements.length > 0 && excludeElements.forEach(el => {
                const element = document.getElementById(el);
                element.style.display = action;
            });
        }
    }

    onMounted(() => {
        createRandomElement();
        emit.on('save_entire_block_as_image'+props.event_id, async (values) => {
            await htmlToImageFunc(values.func, values.attr);
        });
    });

    return {
        htmlToImageFunc
    };
}
