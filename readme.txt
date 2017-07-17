PHP 5.6+

Rewrites: http://altorouter.com/usage/rewrite-requests.html

# Apache .htaccess

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]

# Nginx nginx.conf

try_files $uri /index.php;