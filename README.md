# Trial application for pepita group

The task was to create an event booking application with Laravel and Fullcalendar

## Used frameworks

- [Laravel 10](https://laravel.com)
- [Inertia.js](https://inertiajs.com)
- [Vue.js v3](https://vuejs.org)
- [fullcalendar](https://fullcalendar.io)

## Install

```bash
clone git@github.com:defji/pepita-booking-app
cd pepita-booking-app
# set mysql credentials in .env 
# set business days and hours, for example: 
# BUSINESS_DAYS=1,2,3,4,5
# BUSINESS_HOURS=8,16

composer install

php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

## Usage

- open http://127.0.0.1:8000 in your browser
- Login with admin@demo.co with password: admin123
- Check fullcalendar features
- Check pre-seeded events about specified rules
- Add an event, select a time range
- Try to add overlapped event
- Try to add event outside business hors/days
- Enjoy! 😎

&copy; Balázs Györkös 2023 

