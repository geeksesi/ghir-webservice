<style>
p,h1,h2,h4,h5,h6{direction:rtl; text-align:right}
</style>
<center>به نام خداوند جان و خرد</center>

# مسیریابی ( Router )

### home

| addres |         file         | class@function | description |
| :----: | :------------------: | :------------: | :---------- |
|  `/`   | `/app/Http/Home.php` |  `Home@home`   |             |

### Get
- Get request

|     addres      |           file           | class@function | description |
| :-------------: | :----------------------: | :------------: | :---------- |
|   `/get/sell`   |   `/app/Http/Sell.php`   |   `Sell@get`   |             |
|   `/get/buy`    |   `/app/Http/Buy.php`    |   `Buy@get`    |             |
|   `/get/user`   |   `/app/Http/User.php`   |   `User@get`   |             |
| `/get/position` | `/app/Http/position.php` | `position@get` |             |
| `/get/account`  | `/app/Http/account.php`  | `account@get`  |             |

### Set
- Post request with encryption

|     addres      |           file           | class@function | description |
| :-------------: | :----------------------: | :------------: | :---------- |
|   `/set/sell`   |   `/app/Http/Sell.php`   |   `Sell@set`   |             |
|   `/set/buy`    |   `/app/Http/Buy.php`    |   `Buy@set`    |             |
|   `/set/user`   |   `/app/Http/User.php`   |   `User@set`   |             |
| `/get/position` | `/app/Http/position.php` | `position@set` |             |
| `/get/account`  | `/app/Http/account.php`  | `account@set`  |             |


### Update
- Post request with encryption

|     addres      |           file           |  class@function   | description |
| :-------------: | :----------------------: | :---------------: | :---------- |
| `/update/sell`  |   `/app/Http/Sell.php`   |   `Sell@update`   |             |
|  `/update/buy`  |   `/app/Http/Buy.php`    |   `Buy@update`    |             |
| `/update/user`  |   `/app/Http/User.php`   |   `User@update`   |             |
| `/get/position` | `/app/Http/position.php` | `position@update` |             |
| `/get/account`  | `/app/Http/account.php`  | `account@update`  |             |


## more information
- router file : `/routes/web/php`
- [laravel/lumeon Document about routing](https://lumen.laravel.com/docs/5.8/routing)

<dl>

## نکته
این فایل فقط حاوی مسیر های اصلی می‌باشد.

در مستندات هر فایل یک سری مسیر‌های فرعی نیز موجود می باشند که کد آنها در فایل روتر قرار دارد.

</dl>