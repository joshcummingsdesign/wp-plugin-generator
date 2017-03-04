var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('default', function () {

  browserSync.init({
    proxy: "generator.dev"
  });

  gulp.watch("./assets/**/*").on('change', browserSync.reload);
  gulp.watch("./index.php").on('change', browserSync.reload);
});
