const gulp = require('gulp');
const gulpif = require('gulp-if');
const concat = require('gulp-concat');

gulp.task('css_vendor', () => {
    return gulp.src([
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/slick-carousel/slick/slick.css',
        'bower_components/slick-carousel/slick/slick-theme.css'])
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest('css/'))
});

gulp.task('js_vendor', () => {
    return gulp.src([
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/jquery.easing/js/jquery.easing.min.js',
        'bower_components/slick-carousel/slick/slick.min.js'])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest('js/'))
});

gulp.task('default', [
    'css_vendor',
    'js_vendor'
]);