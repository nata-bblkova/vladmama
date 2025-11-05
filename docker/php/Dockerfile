FROM php:8.4-fpm

RUN apt-get update && apt-get install --yes --no-install-recommends \
    sudo \
    git \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    nano

# libpng-dev, libjpeg-dev нужны для gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer --version

# Install node and yarn
#RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
#    && curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
#    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
#    && apt-get update && apt-get install -y --no-install-recommends \
#    nodejs \
#    yarn \
#    && rm -r /var/lib/apt/lists/*

# Install and configure php extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
#    && docker-php-ext-install imap \
#    && pecl install ast \
#    && docker-php-ext-enable ast \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --enable-gd \
    && docker-php-ext-install gd
#    && docker-php-ext-configure pcntl --enable-pcntl \
#    && docker-php-ext-install pcntl

# Setup git
#RUN git config --global alias.st status

# setup new user for running app
#RUN useradd -m -s /bin/bash -G sudo deployer && echo "deployer:deployer" | chpasswd
#RUN echo "deployer  ALL=(ALL) NOPASSWD:ALL" | sudo tee /etc/sudoers.d/deployer
#RUN sed -i 's/www-data/deployer/' /usr/local/etc/php-fpm.d/www.conf

CMD sudo php-fpm
