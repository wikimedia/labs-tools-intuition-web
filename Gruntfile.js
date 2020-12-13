/* eslint-env node */
module.exports = function (grunt) {
  grunt.loadNpmTasks('grunt-contrib-qunit');

  grunt.initConfig({
    qunit: {
      options: {
        puppeteer: { args: ['--no-sandbox'] }
      },
      all: ['tests/qunit/index.html']
    }
  });
};
