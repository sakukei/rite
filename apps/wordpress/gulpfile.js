const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync   = require('browser-sync');
const cmq = require('gulp-combine-media-queries');
const plumber = require('gulp-plumber');
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const sassGlob = require("gulp-sass-glob");
const connect = require('gulp-connect-php');
const prettier = require('gulp-prettier');
const prettierPlugin = require('gulp-prettier-plugin');
const babel = require('gulp-babel');

gulp.task('sass', () => {
    return gulp.src('src/sass/**/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err.messageFormatted);
                this.emit('end');
            }
        }))
        .pipe(sassGlob())
        // Sassのコンパイルを実行
        .pipe(sass({
            outputStyle: 'expanded'
        }))
        .pipe(cmq())
        .pipe(postcss([
            autoprefixer({
                // IEは11以上、Androidは4.4以上
                // その他は最新2バージョンで必要なベンダープレフィックスを付与する設定
                browsers: ["last 2 versions", "ie >= 11", "Android >= 4"],
                cascade: false,
                grid: 'autoplace'
            }),
        ]))
        .pipe(gulp.dest('./htdocs/wp-content/themes/welcart_basic-square/'))
});

gulp.task('babel', () =>
    gulp.src('src/es6/**/*.js')
        .pipe(plumber())
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(gulp.dest('./htdocs/wp-content/themes/welcart_basic-square/js/'))
);

gulp.task('prettier', () => {
    return gulp.src(['src/sass/**/*.scss','src/es6/*.js'])
        .pipe(
            prettierPlugin(
                {
                    singleQuote: true,
                },
                {
                    filter: true
                }
            )
        )
        .pipe(gulp.dest(file => file.base))
});

gulp.task('connect-sync', function() {
    return connect.server({
        base:'/'
    }, function (){
        browserSync({
            proxy: 'localhost'
        });
    });
});

gulp.task('reload', function(){
    browserSync.reload();
});

gulp.task('default',['connect-sync'], function() {
    gulp.watch('src/sass/**/*.scss',['sass']);
    gulp.watch('src/es6/*.js', ['babel', 'bs-reload']);
    gulp.watch('**/**/*.css',['reload']);
    gulp.watch('**/**/*.php',['reload']);
});