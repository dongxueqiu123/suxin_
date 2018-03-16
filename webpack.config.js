'use strict';

const path = require('path');
const webpack = require('webpack');
// const styleLintPlugin = require('stylelint-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

require('es6-promise').polyfill();

module.exports = {
  entry: [
    './resources/assets/js/app.js',
    './resources/assets/sass/app.scss' 
  ],

  output: {
    path: __dirname,
    filename: 'public/js/app.js'
  },

  plugins: [
    new UglifyJsPlugin()
    // Stylelint plugin
    // new styleLintPlugin({
    //   configFile: '.stylelintrc',
    //   context: '',
    //   files: './resources/assets/sass/**/*.scss',
    //   syntax: 'scss',
    //   failOnError: false,
    //   quiet: true
    // })
  ],

  module: {
    rules: [
      { test: /\.(png|woff|woff2|eot|ttf|svg|gif|png|jpg)$/, loader: 'url-loader?limit=100000' },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [
          'babel-loader'
        ]
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'app.css',
              outputPath: 'public/css/'
            }
          },
          {
            loader: 'extract-loader'
          },
          {
            loader: 'css-loader',
            options: {
              minimize: true
            }
          },
          {
            loader: 'postcss-loader'
          },
          {
            loader: 'sass-loader'
          }
        ]
      }
    ]
  },

  stats: {
    // Colored output
    colors: true
  },

  // Create Sourcemaps for the bundle
  // devtool: 'source-map',
  watch: true
};