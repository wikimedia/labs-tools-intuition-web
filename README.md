[![Tested with QUnit](https://img.shields.io/badge/tested_with-qunit-9c3493.svg)](https://qunitjs.com/)

# intuition-web

Web interface for [Intuition](https://gerrit.wikimedia.org/g/labs/tools/intuition), as deployed at <https://intuition.toolforge.org/>.

## Local development

PHP 7.4 or higher is required, and [Composer](https://getcomposer.org).

<pre lang="sh">
git clone https://gerrit.wikimedia.org/r/labs/tools/intuition-web && cd intuition-web

composer install --no-dev
</pre>

Then, to start a local web server at <http://localhost:4000>.

<pre lang="sh">
php -S localhost:4000 -t public_html/
</pre>
