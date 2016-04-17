'use strict';

var gulp = require('gulp');

var assign = Object.assign || require('object-assign');
var babel = require('gulp-babel');
var batch = require('gulp-batch');
var concat = require('gulp-concat');
var cssmin = require('gulp-minify-css');
var del = require('del');
var jsmin = require('gulp-uglify');
var lint = require('gulp-eslint');
var merge = require('merge-stream');
var rename = require('gulp-rename');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var vinylPaths = require('vinyl-paths');
var watch = require('gulp-watch');

var babelOptions = {
  modules: 'es6',
  moduleIds: false,
  comments: false,
  compact: false,
  stage: 2
};

var devDependencies = {
  js: [
    './bower_components/jquery/dist/jquery.js',
    './bower_components/bootstrap/dist/js/bootstrap.js',
    './bower_components/angular/angular.js',
    './bower_components/angular-ui-router/release/angular-ui-router.js',
    './bower_components/underscore/underscore.js'
  ],
  css: [
    './bower_components/bootstrap/dist/css/bootstrap.css'
  ],
  fonts: [
    './bower_components/bootstrap/dist/fonts/*.*'
  ]
};

gulp.task('dependencies', function() {
  var js = gulp.src(devDependencies.js)
    .pipe(gulp.dest('./dist/js/vendor'));
    
  var css = gulp.src(devDependencies.css)
    .pipe(gulp.dest('./dist/css/vendor'));
    
  var fonts = gulp.src(devDependencies.fonts)
    .pipe(gulp.dest('./dist/css/fonts'));
    
  var partials = gulp.src('./partials/*.html')
    .pipe(gulp.dest('./dist/partials/'));
    
  var images = gulp.src(['./images/*.*', './images/**/*.*'])
    .pipe(gulp.dest('./dist/images/'));
  
  return merge(js, css, fonts, partials, images);
});

gulp.task('clean', function() {
  return gulp.src('./dist/')
    .pipe(vinylPaths(del));
});

gulp.task('build', function() {
  return gulp.src(['./js/*.js', './js/services/*.js', './js/directives/*.js'])
    .pipe(concat('app.js'))
    //.pipe(babel(assign({}, babelOptions, { modules: 'amd' })))
    .pipe(gulp.dest('./dist/js/'));
});

gulp.task('lint', function() {
  return gulp.src('./dist/js/*.js')
    .pipe(lint())
    .pipe(lint.format())
    .pipe(lint.failOnError());
});

gulp.task('sass', function() {
  var normal = gulp.src(['./sass/themes/default/*.scss', './sass/_shared.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('stylesheet.css'))
    .pipe(gulp.dest('./dist/css/themes/default/'));
    
  return normal;
});

gulp.task('partials', function() {
  return gulp.src('./partials/*.html')
    .pipe(gulp.dest('./dist/partials/'))
});

gulp.task('minify-js', function() {
  return gulp.src(['./dist/js/vendor/*.js', './dist/js/*.js'])
    .pipe(jsmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./dist/js/'));
});

gulp.task('minify-css', function() {
  var shared = gulp.src('./dist/css/vendor/*.css')
    .pipe(cssmin({ keepSpecialComments: 0 }))
    .pipe(rename({ basename: 'vendor', suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/vendor'));
    
  var normal = gulp.src('./dist/css/themes/default/*.css')
    .pipe(cssmin({ keepSpecialComments: 0 }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/themes/default/'));
  
  return merge(shared, normal);
});

gulp.task('watch', function() {
    watch(['js/*.js', 'js/**/*.js', 'partials/*.html', 'sass/*.scss', 'sass/themes/**/*.scss'], batch(function(events, done) {
        gulp.start('default', done);
    }));
});

gulp.task('default', function(callback) {
  return runSequence(
    'clean',
    'dependencies',
    'build',
    'lint',
    'sass',
    callback
  );
});

gulp.task('production', function(callback) {
  return runSequence(
    'clean',
    'dependencies',
    'build',
    'sass',
    ['minify-js', 'minify-css'],
    callback
  );
});
