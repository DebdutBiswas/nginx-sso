# nginx-sso
Single-Sign-On integration with Nginx reverse proxy to secure proxy backend web apps

## Features:
- Protectes any kind of http, https and web socket proxied backend
- Directly integrated with Nginx auth_request module
- Customizable php backend can be further integrated with other backend apps

## Working:
Here is a small diagram describes our sso server mechanism:

![Nginx SSO](/assets/images/nginx-sso-diagram.png)

## Usage:
We can easily integrate with existing Nginx configuration like so:
```
http {
    .
    .
    .

    upstream php-fpm {
        server 127.0.0.1:9123;
    }

    include /home/www-data/nginx_root/conf/sso-server.conf;

    server {
        listen       0.0.0.0:80;
        server_name  dashboard.sso-protected.local;

        add_header  Origin "$scheme://$server_name";
        add_header  X-Content-Type-Options  "nosniff";
        add_header  X-Frame-Options "sameorigin";
        add_header  X-Powered-By    "Reverse Proxy Server";
        add_header  X-Xss-Protection    "1; mode=block";

        location / {
            auth_request      /auth_endpoint;
            error_page 401 = @error401;

            root   /home/www-data/nginx_root/websites/dashboard.sso-protected.local;
            index  index.html;

            if ($http_host != $server_name) {
                return 404;
            }
        }
        include /home/www-data/nginx_root/conf/auth-request.conf;

        include /home/www-data/nginx_root/conf/dynamic_error.conf;
        error_page   400 401 402 403 404 405 406 408 409 410 411 412 413 414 415 416 421 429 494 495 496 497 500 501 502 503 504 505 507 /error.html;
    }
}
```