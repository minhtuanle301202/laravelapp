# Sử dụng image PHP 8.0 cùng với Apache
FROM php:8.2-apache

# Cài đặt các thư viện cần thiết cho PHP và các extension
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Cài đặt các extension PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Làm sạch cache của apt-get
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Thiết lập /var/www làm thư mục làm việc
WORKDIR /var/www

# Cài đặt Composer từ image Composer chính thức
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo và cài đặt user 'www'
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Sao chép tất cả dữ liệu từ thư mục hiện tại vào /var/www
COPY . /var/www

# Chuyển quyền sở hữu cho tất cả các file sang user 'www'
COPY --chown=www:www . /var/www

# Đổi người dùng hiện tại thành 'www'
USER www

# Mở cổng 8000 để nghe
EXPOSE 8000

# Định nghĩa câu lệnh để chạy server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

