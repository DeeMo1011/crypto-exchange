# Crypto Exchange System

ระบบแลกเปลี่ยนสกุลเงินดิจิทัลและเงิน Fiat (THB, USD)

## วิธีการติดตั้ง

git clone https://github.com/your-username/crypto-exchange.git
cd crypto-exchange
composer install
cp .env.example .env
php artisan key:generate
php artisan session:table
php artisan migrate
php artisan serve

## วิธีทดสอบข้อมูลด้วย tinker
php artisan tinker

## ดูผู้ใช้งานทั้งหมด
>>> \App\Models\User::all();
>>> \App\Models\Order::all();

## สร้างรายการการซื้อ 

$user = \App\Models\User::first();

$user->orders()->create([
    'order_type' => 'buy',
    'fiat_currency' => 'THB',
    'crypto_currency' => 'BTC',
    'amount_fiat' => 10000,
    'amount_crypto' => 0.002,
    'status' => 'pending',
]);

## ดูรายการการซื้อ 

\App\Models\Order::all();

## สร้าง wallets 
$user->wallets()->create([
    'currency' => 'BTC',
    'balance' => 0.005
]);

## ดู wallets 

$user->wallets;

