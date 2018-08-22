/* eslint-env node */
module.exports = function (grunt) {
  grunt.loadNpmTasks('grunt-eslint');
  grunt.loadNpmTasks('grunt-contrib-qunit');

  grunt.initConfig({
    eslint: {
      all: ['*.js', '{js-env,public_html}/*.js']
    },
    qunit: {
      options: {
        puppeteer: !process.env.CI ? {} : {
          args: [
            // https://docs.travis-ci.com/user/chrome#sandboxing
            '--no-sandbox'
          ]
        }
      },
      all: ['tests/qunit/index.html']
    }
  });

  grunt.registerTask('default', ['eslint', 'qunit']);
};
