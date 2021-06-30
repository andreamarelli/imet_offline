export default {

    props:{
        opacity: {
            type: Number,
            default: 0.6
        }
    },

    methods: {

        __normalize(numbers, max){
            max = max || Math.max(...numbers)
            if(!isNaN(max) && max>0){
                let ratio = max / 100;
                numbers = numbers.map(v => Math.round(v / ratio));
            }
            return numbers;
        },

        __classify(numbers, num_steps=4){
            let classify = function(num_steps){
                return function(number) {
                    if (number === null) {
                        return null;
                    }
                    let class_index = 0;
                    let i = 0;
                    while (i < 100) {
                        if (number > i && number <= i + 100 / num_steps) {
                            return class_index;
                        }
                        i = i + 100 / num_steps;
                        class_index++;
                    }
                    return 0;
                };
            };
            return numbers.map(classify(num_steps));
        },


        choropleth(data, palette){
            let keys = [],
                values = [];
            Object.entries(data).forEach(function(item){
                keys.push(item[0]);
                values.push(item[1]);
            });
            values = this.__normalize(values);
            values = this.__classify(values, palette.length);
            data = _.zipObject(keys, values);
            return data;
        }

    }
}