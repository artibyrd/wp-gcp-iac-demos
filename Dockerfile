FROM wordpress

# Use docker-php-extension-installer to simplify installing some extra PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions xdebug xml yaml

# Replace default PHP ini file with customized settings from our repository
COPY src/php.ini /tmp/php.ini
RUN mv "/tmp/php.ini" "$PHP_INI_DIR/php.ini"

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Google Cloud Client Library Secret Manager component for PHP
RUN composer require google/cloud-secret-manager

# Replace default WordPress config file with version from our repository
COPY src/wp-config.php /var/www/html/wp-config.php

# Include a custom WP plugin and theme from our repository in the docker image
COPY src/wp-plugin-demo /var/www/html/wp-content/plugins/wp-plugin-demo/
COPY src/wp-theme-demo /var/www/html/wp-content/themes/wp-theme-demo/