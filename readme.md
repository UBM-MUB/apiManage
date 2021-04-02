# API throttling system 
 No third party library/framework used for the implementation. Controlling api traffic requests 
## Api calls

apiManage/router.php?action=listing=> Listing all the places

apiManage/router.php?action=details&id=$id => Show the details of each place

## Traffic control functions

```php
$traffic = new Throttle();
$traffic::trafficControll($action); // request based checking traffic
```
## Configuration reset option
Crednitals are admin345/Admin@dfg
Urls to access  admin url apiManage/admin
## Working set up

Db available in data/db.sql
Corresponding settings update in classes/dbclass.php file.

## Working flow
Configutration setted as duration(time period ,unit is in seconds) and limit(no of requests per duration).There is no ip wise checking to control, time and no of request based limits checking while calling api.The limitng values is setted in `configuration` table. Option to change configuration from admin side.



