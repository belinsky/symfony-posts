var gulp = require('gulp'),
    concatCss = require('gulp-concat-css'),
    cleanCSS = require('gulp-clean-css'),
    // coffee = require('gulp-coffee'),
    // rename = require("gulp-rename"),
    sass = require('gulp-sass'),
    jade = require('gulp-jade'),
    ext = require('gulp-ext-replace');

gulp.task('sass', function () {
    return gulp.src('./tmp/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS(''))
        .pipe(gulp.dest('./web/css/'));
});
gulp.task('jade', function() {
  var modules = ['comment', 'post', 'query', 'type', 'test'];
  for (i=modules.length;i--;){
    gulp.src('./tmp/jade/' + modules[i] + '/*.jade')
        .pipe(jade())
        .pipe(ext('.php'))
        .pipe(gulp.dest('./apps/custom/modules/' + modules[i] + '/templates/'));
  };
  return;
});

// gulp.task('coffee', function() {
//     return gulp.src('./tmp/coffee/*.coffee')
//         .pipe(coffee())
//         .pipe(gulp.dest('./app/js/'));
// });

gulp.task('watch', function() {
  gulp.watch('./tmp/sass/*.scss', ['sass']);
  gulp.watch('./tmp/jade/*.jade', ['jade']);
  // gulp.watch('./tmp/coffee/*.coffee', ['coffee']);
  // gulp.watch('./tmp/server/*', ['server']);
});
gulp.task('default', ['sass', 'jade', 'watch']);
