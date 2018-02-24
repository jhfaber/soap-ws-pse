## Purpose
This small project was developed for a technical test made by PlacetoPay with the purpose of verify the abilities to understand a problem from standard documentation.

The project consist of a connection with the PSE WebService offered by PlacetoPay. This connection allows a basic payment process.

Once you are registered (this is just to save all transactions per user) you can perform transactions (payments), list all previously made transactions and see the stored details of any of these transactions.

[**Live demo**](http://placetopay-test.us-west-2.elasticbeanstalk.com/)

## How it works
There is only one class responsible of connecting to the WebService, the [Consumer Class](app/Soap/Consumer.php). This class receives a client (generally this will be a SoapClient) and an optional Authentication object, in this case an [Auth object](app/Soap/Auth.php) that is responsible of creating correct authentication data for this use case.

To keep this Consumer class short, a class is created for every WebService method. So if there is a getBooks WebService mehod, there is a GetBooks class that makes the actual WebService call.
All this classes are in `app/Soap/Methods` and this is where the Consumer will look for the class to make the WebService call.
So, a call to `$consumer->getBooks()` would be routed to another class called `App\Soap\Methods\GetBooks`.

If one WebService method should be cached, the respective class only has to implement the [Cacheable Interface](app/Soap/Cacheable.php).

Then this two classes (Consumer and Auth) are registered to Laravel's Container, this way they are accesible in the entire application, via a Facade for example.

Now all we have to do from the SoapController is make the calls through the [PlacetoPay Facade](app/Soap/Facades/PlacetoPay.php)

## Installation

1. Clone this repo with `git clone https://github.com/johanquiroga/placetopay-ws-client.git`
1. On project folder run `composer install`
1. Create and setup the database that will be used
1. Create `.env` file with `cp .env.example .env`
1. Set needed environment variables on `.env`. Be careful to set the correct Database information.
1. In `.env` you will have to setup the SOAP WebService server information, such as WSDL address, location, and others.
1. On project folder run `php artisan migrate`


## Problems

If you encounter any problem while installing or running this project feel free to open a thoroughly detailed issue on this repo or contact me via e-mail at johan.c.quiroga@gmail.com
