const { src, dest } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cleanCSS = require("gulp-clean-css");
const sourcemaps = require("gulp-sourcemaps");
const rename = require("gulp-rename");
const browserSync = require("./browserSync");

module.exports = function scss() {
    return src("assets/scss/main.scss")               // <<<<<< MAIN ENTRY FILE
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                includePaths: ["assets/scss"]
            }).on("error", sass.logError)
        )
        .pipe(postcss([autoprefixer()]))
        .pipe(cleanCSS({ level: 2 }))
        .pipe(rename("style.min.css"))               // OUTPUT FILE
        .pipe(sourcemaps.write("."))
        .pipe(dest("assets/css"))                    // OUTPUT DIRECTORY
        .pipe(browserSync.stream());
};
