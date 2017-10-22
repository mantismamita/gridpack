const path = require('path');
const webpack = require('webpack');
const config = require('./config.js');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

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
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    'file-loader'
                ]
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
        new ExtractTextPlugin({
            filename:  (getPath) => {
                return getPath('css/[name].css').replace('css/js', 'css');
            },
            allChunks: true
        }),
        new BrowserSyncPlugin( {
                proxy: config.url,
                files: [
                    '**/*.php'
                ],
                reloadDelay: 0
            }
        ),
        /*new webpack.optimize.CommonsChunkPlugin({
            name: 'common'
        })*/
    ]
}