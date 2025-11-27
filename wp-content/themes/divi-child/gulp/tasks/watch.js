require("dotenv").config();
const gulp = require("gulp");
const browserSync = require("./browserSync");
const path = require("path");
const { themePath } = require("./detectTheme");

// SCSS files
const themeScss = [
  path.join(themePath, "assets/scss/**/*.scss"),
  "!" + path.join(themePath, "assets/css/**/*.css"),
];

// Project root = C:/laragon/www/gtm-sftp
const projectRoot = path.resolve(themePath, "../../../");

function watch() {

  browserSync.init({
    server: { baseDir: projectRoot },
    open: true,
    notify: false,
    injectChanges: true,
  });

  // 🔄 Reload on HTML change
  gulp.watch(path.join(projectRoot, "**/*.html")).on("change", file => {
    console.log("📄 HTML updated:", file);
    browserSync.reload();
  });

  // 🔥 Compile SCSS + auto-inject without page refresh
  gulp.watch(themeScss, gulp.series("scss")).on("change", () => {
    console.log("🎨 SCSS Recompiled (CSS Injected)");
    browserSync.reload();
  });

  // 🔥 Rebuild JS + reload
  gulp.watch(path.join(themePath, "assets/js/src/**/*.js"), gulp.series("scripts")).on("change", () => {
    console.log("⚡ JS changed → browser refresh");
    browserSync.reload();
  });
}

module.exports = watch;
