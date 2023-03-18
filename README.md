<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Overview

  

## Setup

  


After cloning the repo you should run command

**composer install**

It may me be possible that application key is needed - to generate one execute

**php artisan key:generate**


To create a table in database it is needed to run migrations

**php artisan migrate**

  


If desired, the database could be populated with dummy data by running the seeder

**php artisan db:seed --class=RealEstateFactorySeeder**

  

## API
  
Use Postman or similar software to use API

Store method can be accessed via POST request on route 
**/api/real-estate-entries**

You can search the real estate properties with this GET route
**/api/real-estate-entries**

Filter parameters available for search are 

 - address
 - min_size
 - max_size
 - bedrooms
 - price_min
 - price_max
 
To search properties that are in radius of some point use following parameters 
 - latitude
 - longitude
 - radius
 
 Radius search is impleneted using **Haversine formula** to calculate great-cricle distance beetwen two points.

## Tests
Feature tests are located in 

**tests\Feature\RealEstatePropertyTest.php**

and they can be executed by using 

**php artisan test**
