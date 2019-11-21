# Image-placeholder
Simple image placeholder

.htaccess file setup
```
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?params=$1 [L,NC,NE]
```

# Usage:
http://domain.com/300x400/222

300x400 - image size

222 - image background
