const path = require('path');
const webpack = require('webpack');
const config = require('./config.js');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const devMode = process.env.NODE_ENV !== 'production';

module.exports = {
    entry: {
        main : "./src/index",
        home : "./src/components/templates/home/index",
        single : "./src/components/templates/single/index",
        page : "./src/components/templates/page/index",
        default : "./src/components/templates/default/index"
    },
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: '[name].bundle.js'
    },
    module: {
        rules: [
            {
                test: /\serviceworker.js$/,
                loader: 'file-loader',
                options: {
                    outputPath: 'sw',
                },
            },
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            },
            {
                test: /\.svg$/,
                include: path.resolve( __dirname, "src/icons" ),
                loaders: [
                    'svgo-loader?' + JSON.stringify({
                        plugins: [
                            { removeTitle: true },
                            { convertPathData: false },
                            { removeUselessStrokeAndFill: true }
                        ]
                    }),
                    'svg-sprite-loader?' + JSON.stringify({
                        name: '[name]',
                        prefixize: true
                    })
                ]
            },
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader'
                ]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    'file-loader',
                    {
                        loader: 'image-webpack-loader',
                        options: {
                            exclude: path.resolve( __dirname, "src/icons" )
                        },
                    },
                ],
            }
        ],
    },
    devServer: {
        historyApiFallback: true,
        compress: true,
        port: 9000,
        https: config.url.indexOf('https') > -1 ? true : false,
        publicPath: config.fullPath,
        proxy: {
            '*': {
                'target': config.url,
                'secure': false
            },
            '/': {
                target: config.url,
                secure: false
            }
        },
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
            options: {
                publicPath: './css'
            }
        }),
        new BrowserSyncPlugin( {
            proxy: config.url,
            files: [
                '**/*.php'
            ],
            reloadDelay: 0
        }),
        new webpack.ProvidePlugin({
            datepicker: 'js-datepicker'
        })
    ]
}