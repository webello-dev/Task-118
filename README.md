
<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"  alt="Laravel Logo"></a></p>

  

# About Task-118
This is a project to get flight information from the site [118](https://chartertest3.ir) and search among the information on this site

## Connect to the database

Laravel must be connected to the database to run the project

 1. **In the .env file, you must enter this piece of code**
    `DB_CONNECTION=mysql`
    `DB_HOST=127.0.0.1`
    `DB_PORT=3306`
    `DB_DATABASE=flights_db`
    `DB_USERNAME=root`
    `DB_PASSWORD=`
 2. **Then you need to create the database**
     `php artisan migrate`
 3. **In the next step, you need to enter the information in the database**
`php artisan db:seed --class=FlightsSeeder`

## search in api
To search the database, you need to search through the link below
http://127.0.0.1:8000/search?from=Mashhad&flight_date=2024-10-03