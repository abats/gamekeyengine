var gulp = require('gulp'),
    sass = require('gulp-ruby-sass')
    notify = require("gulp-notify")
    bower = require('gulp-bower');

var config = {
    sassPath: './resources/sass',
    nodeDir: './node_modules'
}

//Watch task
gulp.task('default',function() {
    gulp.watch('./resources/sass/*.scss',['styles']);
});

gulp.task('icons', function() {
    return gulp.src(config.nodeDir + '/font-awesome/fonts/**.*')
        .pipe(gulp.dest('./fonts'));
});

gulp.task('styles', function () {
    return sass(['./resources/sass/*.scss',
        config.nodeDir + '/font-awesome/scss/*.scss'], { sourcemap: true })
        .on('error', sass.logError)

         .pipe(gulp.dest('css'));
});