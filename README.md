==Installation Steps===

git clone https://github.com/rajni221/laravel-ride-booking.git
cd larave-ride-booking
composer install
copy .env.example to .env
php artisan key:generate

==Create database:===
DB_DATABASE=ride_db
DB_USERNAME=root
DB_PASSWORD=

=== Run migrations: ====
php artisan migrate
php artisan serve

== Admin Panel (UI): ====
http://127.0.0.1:8000/admin/rides
