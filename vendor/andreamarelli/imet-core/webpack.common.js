const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const CopyPlugin = require("copy-webpack-plugin");

module.exports = {

    entry: {
        index: ['./src/assets/index.js', './src/assets/index.scss'],
        vendor: ['./src/assets/vendor.js', './src/assets/vendor.scss'],
    },

    output: {
        path: path.resolve(__dirname, 'dist'),
    },

    resolve: {
        alias: {
            '~$': path.resolve(__dirname, '../', 'node_modules/'),
            '~vendor': path.resolve(__dirname, '../', 'vendor/'),
        }
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                enforce: "pre",
                use: ["source-map-loader"],
                exclude: /node_modules/,
            },
            {
                test: /\.[s]*css$/,
                use: [
                    'vue-style-loader',
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            esModule: false,
                        },
                    },
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.(png|jpg|gif)$/i,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 8192,
                            name: '[name].[ext]',
                            outputPath: 'images',
                            publicPath: 'images'
                        },
                    },
                ],
            }
        ],
    },

    plugins: [
        new VueLoaderPlugin(),
        new CopyPlugin({
            patterns: [
                {
                    from: path.resolve(__dirname, 'src', 'assets', 'images'),
                    to: path.resolve(__dirname, 'dist', 'images')
                },
            ],
        }),
    ],
}
