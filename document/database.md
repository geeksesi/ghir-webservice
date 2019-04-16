<style>
dl{direction:rtl; text-align:right}
dt{direction:ltr; text-align:left}
</style>
<center>به نام خداوند جان و خرد</center>

<dl>

# ساختار دیتابیس

</dl>

|   sell_order    |    buy_order    |        position        |     user     | account  |
| :-------------: | :-------------: | :--------------------: | :----------: | :------: |
|       id        |       id        |           id           |      id      |    id    |
|   order_price   |   order_price   |     position_gain      | user_status  |   bank   |
| order_quantity  | order_quantity  |     position_type      |     name     |  sheba   |
|     user_id     |     user_id     |     position_price     |  user_name   | owner_id |
| order_timestamp | order_timestamp |   position_quantity    |   password   |          |
|                 |                 |        user_id         | phone_number |          |
|                 |                 |   position_timestamp   |  account_id  |          |
|                 |                 | position_old_timestamp | user_credit  |          |
|                 |                 |        corr_id         |              |          |

<dl>

# ساختار ذخیره داده

</dl>

|    sell_order    |    buy_order     |     position     |     user     |     account      |
| :--------------: | :--------------: | :--------------: | :----------: | :--------------: |
|   unsigned_int   |   unsigned_int   |   unsigned_int   | unsigned_int |   unsigned_int   |
| unsigned_big_int | unsigned_big_int |   float(10, 4)   | varchar(40)  |   varchar(30)    |
| unsigned_big_int | unsigned_big_int |    varchar(5)    | varchar(40)  |   varchar(30)    |
|   unsigned_int   |   unsigned_int   | unsigned_big_int | varchar(40)  | unsigned_int(20) |
| unsigned_big_int | unsigned_big_int | unsigned_big_int |     text     |                  |
|                  |                  |  unsigned__int   | varchar(14)  |                  |
|                  |                  | unsigned_big_int | unsigned_int |                  |
|                  |                  | unsigned_big_int | float(10, 4) |                  |
|                  |                  |   unsigned_int   |              |                  |


---

### position_type :
- buy
- sell

### Date type :
**unix_time**

like : ` 1554081890 `


### user auth
with phone and sms :)



## Code

مسیر فایل های مرتبط با ساخت دیتابیس
```project_root/database/migrations/*.php```

[اطلاعات بیشتر...](https://laravel.com/docs/5.8/migrations#creating-columns)




