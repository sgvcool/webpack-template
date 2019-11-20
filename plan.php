<?php 
/**
 * 1) ЩО ТАКЕ WEBPACK? ДЛЯ ЧОГО ВІН ПОТРІБНИЙ?
 */
?>

<?php 
/**
 * 2) ВСТАНОВЛЕННЯ WEBPACK
 * 
 * - ствоюємо папку webpacktemplate і переходимо в неї
 * - якщо потрібно встановлюємо собі на комп'ютер nodejs https://nodejs.org/uk/
 * - npm init (створює файл package.json описує наш проект)  
 * - npm install webpack webpack-cli webpack-dev-server path --save-dev
 * (--save-dev) -  зробить запис в пакедж джсон, в devDependecies
 * 
 */
?>

<?php 
/**
 * 3) СТВОРЕННЯ ЯРЛИКІВ ЗБОРКИ WEBPACK
 * (продакшин і дев, в дев мод зборка проекту відбувається бистріше, але не створюється папка dist)
 * 
 * - створюємо index.html  в корні 
 * - додаєм в нього <script src="/dist/app.js"></script>
 * - створюємо index.js в src
 * - дописуємо в packege.json
 */

 /*
"scripts": {
  "dev": "webpack-dev-server --open --mode development",
  "build": "webpack --mode production",

  "test" : "node src/index.js"
},
 */

 /**
  * - відкриваємо наш packege.json, дивимось чи добавились наші devDepencies
  * - запускаємо команду npm run test ( наш кастомний скріпт)
  * - npm run build ( перевіряємо чи збирається наш бандл)
  */
?>

<?php 
/**
 * 4) СТВОРЕННЯ КОНФІГУ WEBPACK
 * 
 * - створюємо файл webpack.config.js в корні дерикторії 
 */ 

 /*
  const path = require('path') 
  module.exports = {
    entry: {
      app: './src/index.js'
    },
    output: {
      filename: '[name].js',
      path: path.resolve(__dirname, './dist'),
      publicPath: '/dist'
    },
    devServer: {
      overlay: true 
    },
  }
*/

/**
 * - точка входа
 * - точка вихода
 * - настройка дев сервера 
 * - overlay: true  -  відкриття нашого дев сервера в окремому вікні
 * - public: "http://exemple.com",
 */ 

 ?>

<?php 
/**
 * 5) import js в основний js файл
 *
 * - створюємо index.html  в корні 
 * - створюємо wrapper
 * - підключаємо наш /dist/app.js
 * - створюємо common.js
 * - підключаємо import './js/common';  в index.js
 * 
 * import './common';
 * 
 * - запускаєм webpack
 * - npm run dev 
 */ ?>


<?php 
/**
 * 6) УСТАНОВКА І НАСТРОЙКА BABEL. Конфігурація .babelrc
 * 
 * - що це таке, для чого потрібний?
 * - npm install @babel/core @babel/preset-env babel-loader --save-dev
 * - добавляєм лоадер для обработки js файлів в webpack.config.js 
 */


 /*
 module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: '/node_modules/'
      },
    ]
  }
 */

 /**
  * - створюємо .babelrc в корні
  * - вставляєм в нього

  {
    "presets": [
      "@babel/preset-env"
    ]
  }



  * - додаєм трохи ES6 common.js

  let sum  = (a,b) => a + b;
  console.log(sum(3,4)); 

  * - запускаєм npm run dev ( перевіряем чи все у нас нормально збирається)
  */
  ?>


<?php 
/**
 * 7) WEBPACK, СSS
 * 
 * - створюєм папки css scss
 * - npm install css-loader mini-css-extract-plugin --save-dev
 * - створюємо /css/main.css

    .wrapper{
      background: #000;
      border-radius: 5px;
      margin: 30px;
    } 

 * - підключаєм в index.js 

   import './css/main.css';

 * - добавляем зверху файлу webpack.config
   
   const MiniCssExtractPlugin = require("mini-css-extract-plugin");

 * - добавляєм в webpack.config знизу секцію плагінс для наших майбутніх плагінів
 
  {
    test: /\.css$/,
    use: [
      MiniCssExtractPlugin.loader,
      "css-loader"
    ]
  }

 * - запускаєм npm run dev
  - добавляєм в index.html
  <link rel="stylesheet" href="/dist/app.css">



  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
    })
  ],
  
 */
?>


<?php 
/**
 * 8) WEBPACK, SASS
 * 
 * - npm install style-loader sass-loader node-sass --save-dev
 * 
 * - додаємо в webpack.config
 * 
 
  {
    test: /\.scss$/,
    use: [
      'style-loader',
      MiniCssExtractPlugin.loader,
      {
        loader: 'css-loader',
        options: { sourceMap: true }
      }, {
        loader: 'sass-loader',
        options: { sourceMap: true }
      }
    ]
  }

 * - створюємо файл scss\main.scss
 * - прописуємо в ньому стилі
 * - добавляєм код імпорту в index.js
 * 
    import './scss/main.scss'
 * - npm run build
 * - npm run dev
 * 
 */?>



<?php 
/**
 * 9) НАСТРОЙКА І УСТАНОВКА POSTCSS ПЛАГІНІВ
 * 
 * - створюємо файл src/js/postcss.config.js
 * - добавляєм в нього
 * 
  module.exports = {
    plugins: [
      require('autoprefixer'),
      require('css-mqpacker'),
      require('cssnano')({
        preset: [
          'default', {
            discardComments: {
              removeAll: true,
            }
          }
        ]
      })
    ]
  }

 * - autoprefixer - проставляєм префікси
 * - css-mqpacker - робота медіа запросами
 * - cssnano - максимально мінімізуєм наші стилі
 * 
 * - npm install postcss-loader autoprefixer css-mqpacker cssnano --save-dev
 * 
 * - Для роботи автопрефіксера в файлі package.json пропишем наступне:
 * 
  "browserslist": [
      "> 1%",
      "last 3 version"
  ],
 * 
 * -  для підключення postcss-loader для css и sass змінюєм настройки вебпака
 * 
 * 

    {
      test: /\.css$/,
      use: [
        'style-loader',
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: { sourceMap: true }
        }, {
          loader: 'postcss-loader',
          options: { sourceMap: true, config: { path: 'src/js/postcss.config.js' } }
        }
      ]
    }

 * 
 * 

    {
      test: /\.scss$/,
      use: [
        'style-loader',
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: { sourceMap: true }
        }, {
          loader: 'postcss-loader',
          options: { sourceMap: true, config: { path: 'src/js/postcss.config.js' } }
        }, {
          loader: 'sass-loader',
          options: { sourceMap: true }
        }
      ]
    }

 * 
 * - npm run build
 * - npm run dev
 * - відкриваєм app.css  перевіряєм наші плагіни
 * 
 */?>



<?php 
/**
 * 10) РОЗПОДІЛ ЗБОРКИ WEBPACK ДЛЯ ДЕВ І ПРОДАКШИН
 * 
 * - npm i webpack-merge --save-dev (для мержа наших конфігів вебпака)
 * 
 * - webpack.config.js -  переіменовуємо на webpack.base.conf.js , лишнє видаляєм
 * - webpack.build.conf.js
 * - webpack.dev.conf.js
 * 
 * - В package.json обновим ярлики для dev і build:
 * 
    "scripts": {
      "dev": "webpack-dev-server --open --config webpack.dev.conf.js",
      "build": "webpack --config webpack.build.conf.js"
    },
 * 
 * 
 * 
 * - пишем webpack.build.conf.js (прописуєм мод, додаєм мерж бейз конфік)
 * 
    const merge = require('webpack-merge')
    const baseWebpackConfig = require('./webpack.base.conf')

    const buildWebpackConfig = merge(baseWebpackConfig, {
      // BUILD settings gonna be here
      mode: 'production',

      plugins: []
    });

    // export buildWebpackConfig
    module.exports = new Promise((resolve, reject) => {
      resolve(buildWebpackConfig)
    })
 * 
 * 
 * - копіюєм все з білд, вставляем в дев, змінюєм наш код під девелопмент
 * - створюємо const webpack = require('webpack')
 * - змінюєм мод, додаєм сорс меп, дев сервера
 * 
    devServer: {
      port: 8081,
      overlay: {
        warnings: true,
        errors: true
      }
    },
 * 
 * - додаємо в дев конфіг, для нашої карти стилів
 * 
    plugins: [
      new webpack.SourceMapDevToolPlugin({
        filename: '[file].map'
      })
    ]
 * 
 * 
 * 
 * - в scss створюємо підпапки (наприклад utils i modules) - додаєм в main.scss імпорти наших модулів, інших файлів
 * - додаєм devtool: 'cheap-module-eval-source-map',
 * - npm run dev

 *  - визиваєм інспектор кода, перевіряємо чи підтягнулась наша карта
 *
 */?> 


<?php 
/**
 * 11) МІНІФІКАЦІЯ ЗОБРАЖЕНЬ
 * 
 * 
 * - npm install imagemin-webpack-plugin
 * - dev config створюємо константу
 * 
    const ImageminPlugin = require('imagemin-webpack-plugin').default

 * - в розділ плагінс  додаєм код
 * 
 * 

      new ImageminPlugin({ 
        test: /\.(jpe?g|png|gif|svg)$/i
      }) 

 * - npm run dev
 * - npm run build
 *
 */?> 