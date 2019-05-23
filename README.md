# S4F Test

## Start & Stop environment 
```
$ docker-compose up -d

$ docker-compose stop
```

## Install vendors
```
$ docker-compose exec php composer install
```

## Create database
```
$ docker-compose exec php bin/console doctrine:schema:create
```

## Run tests

```
$ docker-compose exec php ./bin/phpunit
```

## Examples
### Create

```
    POST http://localhost/exchanges/  
    
    {
	    "currency": "USD",
	    "rate": "11"
    }    
```

### Update

```
    PUT http://localhost/exchanges/USD
    
    {
	    "rate": "100"
    }   
```

### Get

```
    GET http://localhost/exchanges/USD      
```

## TODO
- Move storage calls to repository
- Remove annotations from Entity to xml 
- Validations
- Error control
- Finish tests





