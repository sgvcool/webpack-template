const webpack = require("webpack")
const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')
const ImageminPlugin = require('imagemin-webpack-plugin').default

const devWebpackConfig = merge(baseWebpackConfig, {
  // BUILD settings gonna be here
  mode: 'development',
  devtool: 'cheap-module-eval-source-map',
  devServer: {
    //contentBase: baseWebpackConfig.externals.paths.dist,
    //contentBase: baseWebpackConfig.externals.paths.dist,
    overlay: {
      warnings: true,
      errors: true
    },
    port: 8081,
  },
  plugins: [
    new webpack.SourceMapDevToolPlugin({
      filename: '[file].map'
    }),
    new ImageminPlugin({ 
      test: /\.(jpe?g|png|gif|svg)$/i
    }) 
  ]
});

// export buildWebpackConfig
module.exports = new Promise((resolve, reject) => {
  resolve(devWebpackConfig)
})