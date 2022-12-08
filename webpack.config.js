const TerserJSPlugin = require('terser-webpack-plugin');
const path = require('path');
const webpack = require('webpack');

module.exports = {
    optimization: {
        minimizer: [new TerserJSPlugin({})],
    },
    entry: ['./app.js'],
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: './index.js',
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
            },
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
            },
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            Buffer: ['buffer', 'Buffer'],
        }),
    ],
    experiments: {
        topLevelAwait: true
    }
}