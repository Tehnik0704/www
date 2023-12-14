;(function(){
	"use strict";

	const gulp 		= require('gulp'),
		sourcemaps  = require('gulp-sourcemaps'),
		sass        = require('gulp-sass'),
		sassVars    = require('gulp-sass-vars'),
		root        = './application/',
		PARAMS      = {
			source: {
				'themeMain': './themes/main-template/',
				'themeJk': './themes/jk-template/',
			},
		},
		themes = {
			'main': {
				'orange': {
					'main': '#FF7800',
					'hover': '#ff5400'
				}
			},
			'jk': {
				'blue': {
					'main': '#2dc1fe',
					'hover': '#0099ff'
				}
			}
		};
	
	gulp.task('theme-main', function () {
		for ( var themeName in themes.main) {
			var themePath = PARAMS.source.themeMain + themeName+'/',
				color = themes['main'][themeName];
			
			gulp.src(PARAMS.source.themeMain + '*.scss')
				.pipe(sassVars({'primary-color': color.main, 'hover-color': color.hover}, { verbose: true }))
				.pipe(sourcemaps.init())
				.pipe(sass(/*{outputStyle: 'compressed'}*/).on('error', sass.logError))
				//.pipe(sourcemaps.write('.',{includeContent: false, sourceRoot: '../'}))
				.pipe(gulp.dest(themePath));
		}
	});
	gulp.task('theme-jk', function () {
		for ( var themeName in themes.jk) {
			var themePath = PARAMS.source.themeJk + themeName + '/',
				color = themes['jk'][themeName];
			
			gulp.src(PARAMS.source.themeJk + '*.scss')
				.pipe(sassVars({'primary-color': color.main, 'hover-color': color.hover}, {verbose: true}))
				.pipe(sourcemaps.init())
				.pipe(sass(/*{outputStyle: 'compressed'}*/).on('error', sass.logError))
				//.pipe(sourcemaps.write('.', {includeContent: false, sourceRoot: '../'}))
				.pipe(gulp.dest(themePath));
		}
	});
	//themes
	gulp.task('theme', ['theme-main', 'theme-jk']);
	gulp.task('theme:w', function () {
		gulp.watch(PARAMS.source.themeMain+'*.scss', ['theme-main']);
		gulp.watch(PARAMS.source.themeJk+'*.scss', ['theme-jk']);
	});


})();