# Quotation App
This is a laravel based project, developed by Alan Malnique Justino, to calculate quotations of health insurance for trips.

## Requirements
- PHP (>=8.2)
- Composer 2
- Node 20.10.0
- MySQL

## How to configure the project
- Start running:
  - `composer install`
- Then, you have to generate the app key running:
  - `php artisan key:generate`
- Create a database in your MySQL server, and then run:
  - `php artisan migrate`
- After running the migrations, you have to run the seeder to populate some tables running:
  - `php artisan db:seed`
- After all, you can run the server by running:
  - `php artisan serve`

## Notes
- If you want to make some changes at the front-end, you have to run:
  - `npm install`
- After install all packages, you have to run the node server:
  - `npm run dev`
- Running that command, you have a live reload server to do your changes and see it in real time.
- After you finish all the changes, you have to run:
  - `npm run build`
- That command will build your application into 'public' folder.
