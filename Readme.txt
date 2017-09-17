// Made by alavon. https://www.alavon.nl/ free to use mvc framework for php

1. Make sure you set your httpd config file to enable MOD_REWRITE to enable rewriting of urls
For example

LoadModule rewrite_module modules/mod_rewrite.so

and

<Directory />
    Options Indexes FollowSymLinks
    AllowOverride None
</Directory>

to

<Directory />
    Options Indexes FollowSymLinks
    AllowOverride All
</Directory>