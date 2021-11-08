const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = merge(common, {
    mode: 'development',

    output: {
        filename: 'prod/modular_forms_[name].js'
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: 'prod/modular_forms_[name].css',
        }),
    ]

});
