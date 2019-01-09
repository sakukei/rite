const path = require('path')

module.exports = {
  // エントリポイントのファイル
  entry: './src/es6/scripts.js',
  output: {
    // 出力ファイル名
    filename: 'bundle.js'
  },
  devServer: {
    // webpackの扱わないファイル(HTMLや画像など)が入っているディレクトリ
    contentBase: path.resolve(__dirname, 'public')
  }
}
