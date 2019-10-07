// including plugins
var concat = require('gulp-concat');

var gulp = require('gulp'),
uglify = require("gulp-uglify");

//Concatenar os arquivos
gulp.task('concacScripts', function() {
    return gulp.src(['./public/assets/js/smooth-scrolling.js',
     './public/assets/js/scrolling-nav.js', 
     './public/assets/js/Chart-rounded.min.js'])
      .pipe(concat('dev/scripts.js'))
      .pipe(gulp.dest('./public/assets/js/'));
});

// Minify file
gulp.task('minifyJS', function () {
    gulp.src('./public/assets/js/dev/scripts.js')// path to your files
    .pipe(uglify())
    .pipe(concat('script.js'))
.pipe(gulp.dest('public/assets/js/dist'));
});

gulp.task('dev', gulp.series('concacScripts','minifyJS'));


