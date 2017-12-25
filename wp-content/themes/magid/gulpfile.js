// Include gulp
var $ = require('gulp-load-plugins')();
var gulp = require('gulp');
var sequence = require('run-sequence');

// File paths to various assets are defined here.
var PATHS = {
    sass: [
        'assets/scss/*.scss',
        'assets/scss/**/*.scss'
    ],
    jsTheme: [
        'assets/js/theme/*.js',
        'assets/js/theme.js'
    ],
    jsVendors: [
        'bower_components/fluidvids/dist/fluidvids.js',
        'bower_components/imagesloaded/imagesloaded.pkgd.min.js',
        'bower_components/matchHeight/dist/jquery.matchHeight.js',
        'bower_components/masonry/dist/masonry.pkgd.js',
        'bower_components/selectize/dist/js/standalone/selectize.js'
    ]
};

// Concatenate & Minify JS Theme scripts
gulp.task('scripts:theme', function () {
    return gulp.src(PATHS.jsTheme)
        .pipe($.concat('theme.js'))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.uglify())
        .pipe(gulp.dest('build/js'));
});

// Concatenate & Minify JS Vendor scripts
gulp.task('scripts:vendor', function () {
    return gulp.src(PATHS.jsVendors)
        .pipe($.concat('vendor.js'))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.uglify())
        .pipe(gulp.dest('build/js'));
});

// Sass concatenate and minify
gulp.task('sass', function () {
    return gulp.src('assets/scss/app.scss')
        .pipe($.sourcemaps.init())
        .pipe($.sass({
            includePaths: PATHS.sass,
            outputStyle: 'compressed',
            indentType: 'tab',
            indentWidth: 1
        })
            .on('error', $.sass.logError))
        .pipe($.rename({
            basename: "style",
            suffix: '.min'
        }))
        .pipe($.cleanCss())
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest('build/css'))
});

// Watch tasks
gulp.task('watch', function () {
    // Watch .js files
    gulp.watch(PATHS.jsTheme, ['scripts:theme']);
    // Watch .js files
    gulp.watch(PATHS.jsVendors, ['scripts:vendor']);
    // Watch .scss files
    gulp.watch(PATHS.sass, ['sass']);
});

// Build the theme assets
gulp.task('build', function (done) {
    sequence(['sass', 'scripts:theme', 'scripts:vendor'], done);
});

// Default task, run the build
gulp.task('default', ['build']);