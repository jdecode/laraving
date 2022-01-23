FROM jdecode/php-8.1:laravel

ARG PORT
ENV PORT=${PORT}

COPY . /var/www/html

# Setup
RUN composer install -n --prefer-dist
#RUN chmod -R 0777 storage bootstrap
#RUN php artisan key:generate --env=testing

# Run tests
#RUN composer run tests


# Run FE specific build steps, if applicable
#RUN npm install
#RUN chmod -R 0777 public
#RUN npm run prod

RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

RUN chmod +x /var/www/html/db-migration.sh

ENTRYPOINT ["/var/www/html/db-migration.sh"]
