// at top
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin   = require('css-minimizer-webpack-plugin');
const TerserPlugin         = require('terser-webpack-plugin');
const FriendlyErrorsWebpackPlugin = require('@soda/friendly-errors-webpack-plugin');

module.exports = {
  // ...
  stats: 'errors-warnings',
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: { loader: 'babel-loader', options: { presets: ['@babel/preset-env'] } }
      },
      {
        test: /\.s?css$/,
        use: [
          MiniCssExtractPlugin.loader,        // or 'style-loader' in dev
          { loader: 'css-loader', options: { importLoaders: 2 } },
          { loader: 'postcss-loader', options: { postcssOptions: { plugins: [require('autoprefixer')] } } },
          'sass-loader'
        ]
      }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({ extractComments: false }),
      new CssMinimizerPlugin()
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({ filename: 'css/[name].css' }),
    new FriendlyErrorsWebpackPlugin()
  ]
};