const autoprefixer = require("autoprefixer");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
var OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
//const PurgecssPlugin = require('purgecss-webpack-plugin');
//const glob = require('glob');
const path = require("path");

const PATHS = {
  dist: path.join(__dirname, "assets/dist/")
};
module.exports = {
  entry: {
    style: [path.join(__dirname, "/assets/scss/theme.style.scss")],
    themefrontend: [path.join(__dirname, "/assets/theme.frontend.js")],
    themebackend: [path.join(__dirname, "/assets/theme.backend.js")]
  },
  output: {
    filename: "[name].min.js",
    path: path.join(__dirname, "assets/dist"),
    publicPath: path.join(__dirname, "assets/dist")
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              importLoaders: 1
            }
          },
          {
            loader: "postcss-loader",
            options: {
              ident: "postcss",
              plugins: [require("autoprefixer")]
            }
          },
          { loader: "sass-loader" }
        ]
      },
      {
        test: /\.css/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "postcss-loader"]
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "/fonts/"
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "style.min.css"
    }),
    new OptimizeCssAssetsPlugin({
      cssProcessor: require("cssnano"),
      cssProcessorPluginOptions: {
        preset: ["default", { discardComments: { removeAll: true } }]
      },
      canPrint: true
    }),
    new BrowserSyncPlugin({
      proxy: 'http://vagrant.headless.local:8000/', // edit here for your own base theme local domain name
      files: ["dist/assets/*.css", "dist/assets/*.js", "./**/*.php"],
    },
    {
      reload: true
    })
    // new PurgecssPlugin({
    //   content: ['*.js', '*.html', '*.php'],
    //   paths: () => glob.sync(`${PATHS.dist}/*`, { nodir: true }),
    // })
  ]
};
