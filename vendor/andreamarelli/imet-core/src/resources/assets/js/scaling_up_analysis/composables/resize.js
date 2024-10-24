import { ref, onMounted, onBeforeUnmount } from 'vue';

export function useResize(component_data) {
    const chart = component_data.chart || ref(null);
    const emitter = component_data.emitter;

    function handleResize(echartObject) {
        echartObject.resize();
    }

    function initResize(echartObject) {
        save_data(echartObject);
        const resize_event = () => handleResize(echartObject);
        window.addEventListener('resize', resize_event)
    }

    function save_data(charContainer) {
        if (charContainer) {
            emitter.on('save_data',(value) => {
                const {comments, image_src, attr, func} = value;
                if (charContainer) {
                    const value = charContainer.getDataURL({
                        pixelRatio: 2,
                        backgroundColor: '#fff'
                    });

                    func(value, attr)
                }
            });
        }
    }

    onBeforeUnmount(() => {
        window.removeEventListener('resize', handleResize);
    });

    return { initResize, save_data, handleResize };
}
