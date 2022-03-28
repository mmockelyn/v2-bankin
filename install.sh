

echo "$1"

if [ $1 == 'install' ]; then
    composer install --no-dev --no-interaction --ignore-platform-reqs
    if [ $2 == 'sandbox' ];
    then
        cp .env.sandbox .env
        php artisan key:generate
        php artisan migrate --force
        php artisan db:seed --class=TestingSeeder
        php artisan queue:restart --quiet
    else
        cp .env.prod .env
        php artisan key:generate
        php artisan migrate --force
        php artisan db:seed
        php artisan queue:restart --quiet
    fi

else
    php artisan down
    git pull origin master
    if [$2 == 'sandbox']
    then
        git checkout master
    else
        git checkout release
    fi
    composer install --no-dev --no-interaction --ignore-platform-reqs
    php artisan migrate --force
    php artisan queue:restart --quiet
    php artisan cache:clear
    php artisan config:clear
    php artisan view:clear
    php artisan route:clear
    php artisan up
fi
