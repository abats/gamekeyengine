var gulp = require('gulp'),
    sass = require('gulp-ruby-sass')
    notify = require("gulp-notify")
    bower = require('gulp-bower');

var config = {
    sassPath: './resources/sass',
    nodeDir: './node_modules'
}

// define tasks here
gulp.task('default', function(){
    // run tasks here
    // set up watch handlers here
});

gulp.task('icons', function() {
    return gulp.src(config.nodeDir + '/font-awesome/fonts/**.*')
        .pipe(gulp.dest('./fonts'));
});

gulp.task('sass', function () {
    return sass(['./resources/sass/*.scss',
        config.nodeDir + '/font-awesome/scss/*.scss'], { sourcemap: true })
        .on('error', sass.logError)

         .pipe(gulp.dest('css'));
});