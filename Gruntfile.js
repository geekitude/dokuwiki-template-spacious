module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.initConfig({

        // Reference package.json
        pkg: grunt.file.readJSON('package.json'),

        postcss: {
            options: {
                map: false,
                processors: [
                    require('autoprefixer')({
                        overrideBrowserlist: ['last 2 versions']
                    }),
                    require('postcss-rtl')()
                ]
            },
            dist: {
                files: {
                    'css/spacious.dark.less': ['css/src/spacious.dark.less'],
                    'css/spacious.less': ['css/src/spacious.less'],
                    'css/spacious.plugins.less': ['css/src/spacious.plugins.less'],
                    'css/spacious.print.css': ['css/src/spacious.print.css'],
                    'css/spacious.theme.less': ['css/src/spacious.theme.less']
                }
            }
        },
        watch: {
            css: {
                files: 'css/src/*.*',
                tasks: ['postcss'],
            }
        }
    });

    grunt.registerTask('default', ['watch']);
};