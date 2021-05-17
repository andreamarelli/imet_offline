export default {

    props:{
        red_yellow_green: {
            type: Array,
            default: () => [
                '#ce2e29',  // $darkRed
                '#f9c74f',
                '#007233'   // $darkGreen
            ]
        },
        rainbow_10:{
            type: Array,
            default: () => [
                '#404887',
                '#3374ff',
                '#43aa8b',
                '#90be6d',
                '#f9c74f',
                '#f3722c',
                '#f94144',
                '#d35e9d',
                '#ad7af6',
                '#e7c1cb',
                '#c9bcb5',
                '#5f6269',
            ]
        }
    },

    methods: {

        /**
         * Generate a gradient color palette (using https://github.com/Siddharth11/gradstop)
         *
         * @param num_colors
         * @param colors
         */
        generateGradientPalette(num_colors, colors) {
            colors = colors || this.red_yellow_green;
            return gradstop({
                stops: num_colors,
                inputFormat: 'hex',
                colorArray: colors
            });
        },

        /**
         * Return a palette from the given array of colors
         *
         * @param num_colors
         * @param colors
         * @returns {T[]}
         */
        generateColorPalette(num_colors, colors) {
            colors = colors || this.rainbow_10;
            return colors.slice(0, num_colors);
        }


    }
}