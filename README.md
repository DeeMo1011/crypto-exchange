# Crypto Exchange System

ระบบแลกเปลี่ยนสกุลเงินดิจิทัลและเงิน Fiat (THB, USD)

## คุณสมบัติ
- สมัครผู้ใช้ และจัดการบัญชี
- ซื้อขายเหรียญกับผู้ใช้คนอื่น
- โอนเหรียญภายในระบบ และภายนอกระบบ
- บันทึกการทำธุรกรรมทั้งหมด

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
