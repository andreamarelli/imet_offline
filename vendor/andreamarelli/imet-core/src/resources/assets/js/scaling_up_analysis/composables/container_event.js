import {ref} from "vue";

export function useEvent(component_data){
    const event_name = component_data.event_name || '';
    const emitter = component_data.emitter || null;

    function load_event(show_view){
        if (event_name) {
            emitter.on(event_name, () => {
                show_view = true;
            });
        }
    }

    return {load_event}
}
