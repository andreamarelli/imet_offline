import { createApp, ref, onMounted } from "vue";
import { createPinia } from "~/pinia";
import imetScores from "../templates/imet_scores.vue";
import { useScoreStore } from "./ScoreStore";

export default class AssessmentScores {

    constructor(input_data = {}) {

        const options = {

            name: 'AssessmentScores',

            props: {
                api_data: {
                    type: Object,
                    default: () => input_data.api_data
                }
            },

            setup(props, context){

                const store = useScoreStore();
                store.init(props.api_data);

                function refresh_scores(){
                    store.refresh();
                }

                return {
                    refresh_scores,
                    store,
                }
            }
        }

        return createApp(options, input_data)
            .component('imet_scores', imetScores)
            .use(createPinia());
    }
}