[![Build Status](https://travis-ci.org/Krinkle/intuition-web.svg?branch=master)](https://travis-ci.org/Krinkle/intuition-web)

# intuition-web

Web interface for [Intuition](https://github.com/Krinkle/intuition).

## Install

PHP 7.0 or higher is required, and [Composer](https://getcomposer.org).

<pre lang="sh">
git clone https://github.com/Krinkle/intuition-web.git && cd intuition-web

composer install --no-dev
</pre>

Then, to start a local web server at <http://localhost:9412>.

<pre lang="sh">
php -S localhost:9412 -t public_html/
</pre>
