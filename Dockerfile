#FROM subodhvirk/php-8.1.1:laravel
FROM jdecode/php-8.1:laravel
#RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql