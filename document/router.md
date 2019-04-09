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

|        addres         |            file             |    class@function    | description |
| :-------------------: | :-------------------------: | :------------------: | :---------- |
|      `/get/sell`      |    `/app/Http/Sell.php`     |      `Sell@get`      |             |
|      `/get/buy`       |     `/app/Http/Buy.php`     |      `Buy@get`       |             |
|      `/get/user`      |    `/app/Http/User.php`     |      `User@get`      |             |
| `/get/user/inventory` |    `/app/Http/User.php`     | `User@inventory_get` |             |
|    `/get/product`     |   `/app/Http/Product.php`   |    `Product@get`     |             |
| `/get/product/price`  |   `/app/Http/Product.php`   | `Product@price_get`  |             |
|  `/get/transaction`   | `/app/Http/Transaction.php` |  `Transaction@get`   |             |

### Set
- Post request with encryption

|        addres         |            file             |    class@function    | description |
| :-------------------: | :-------------------------: | :------------------: | :---------- |
|      `/set/sell`      |    `/app/Http/Sell.php`     |      `Sell@set`      |             |
|      `/set/buy`       |     `/app/Http/Buy.php`     |      `Buy@set`       |             |
|      `/set/user`      |    `/app/Http/User.php`     |      `User@set`      |             |
| `/set/user/inventory` |    `/app/Http/User.php`     | `User@inventory_set` |             |
|    `/set/product`     |   `/app/Http/Product.php`   |    `Product@set`     |             |
| `/set/product/price`  |   `/app/Http/Product.php`   | `Product@price_set`  |             |
|  `/set/transaction`   | `/app/Http/Transaction.php` |  `Transaction@set`   |             |

### Update
- Post request with encryption

|          addres          |            file             |     class@function      | description |
| :----------------------: | :-------------------------: | :---------------------: | :---------- |
|      `/update/sell`      |    `/app/Http/Sell.php`     |      `Sell@update`      |             |
|      `/update/buy`       |     `/app/Http/Buy.php`     |      `Buy@update`       |             |
|      `/update/user`      |    `/app/Http/User.php`     |      `User@update`      |             |
| `/update/user/inventory` |    `/app/Http/User.php`     | `User@inventory_update` |             |
|    `/update/product`     |   `/app/Http/Product.php`   |    `Product@update`     |             |
| `/update/product/price`  |   `/app/Http/Product.php`   | `Product@price_update`  |             |
|  `/update/transaction`   | `/app/Http/Transaction.php` |  `Transaction@update`   |             |


## more information
- router file : `/routes/web/php`
- [laravel/lumeon Document about routing](https://lumen.laravel.com/docs/5.8/routing)