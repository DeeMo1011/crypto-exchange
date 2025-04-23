# Crypto Exchange System

ระบบแลกเปลี่ยนสกุลเงินดิจิทัลและเงิน Fiat (THB, USD)

## วิธีการติดตั้ง

git clone https://github.com/your-username/crypto-exchange.git
cd crypto-exchange
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## วิธีทดสอบข้อมูล
php artisan tinker
>>> App\Models\User::all();
>>> App\Models\Order::all();
