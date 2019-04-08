<style>
p,li,ul.h1,h2,h4,h5,h6{direction:rtl; text-align:right}
</style>
<center>به نام خداوند جان و خرد</center>

# ساختار دیتابیس

  - جدول فروش (sell)
  - جدول خرید (buy)
  - جدول کاربران (users)
  - محصولات (product)
  - قیمت محصولات  (product_price)
  - تراکنش ها (transaction)
  - موجودی کاربر ( inventory )

|      sell       |       buy       |      user      |   product    |  product_price  |      transaction      |       inventory       |
| :-------------: | :-------------: | :------------: | :----------: | :-------------: | :-------------------: | :-------------------: |
|       id        |       id        |       id       |      id      |       id        |          id           |          id           |
|     user_id     |     user_id     |   user_name    | product_name |   product_id    |      product_id       |        user_id        |
|   product_id    |   product_id    |   user_email   |              |    min_price    |       offer_id        |   inventory_change    |
|   offer_value   |   offer_value   |   user_phone   |              |    max_price    |      offer_type       | inventory_change_type |
|   offer_price   |   offer_price   | user_timestamp |              |      price      |   transaction_value   |   inventory_current   |
| offer_timestamp | offer_timestamp |                |              | price_timestamp |   transaction_price   | inventory_timestamp  |
|  offer_status   |  offer_status   |                |              |                 |  transaction_status   | inventory_status|
| transaction_id  | transaction_id  |                |              |  price_status   | transaction_timestamp |
| previous_offer  | previous_offer  |                |              |                 |       seller_id       |
|   next_offer    |   next_offer    |                |              |                 |       buyer_id        |

---

### offer_status

- open
- closed
- removed
- complete
- edited
- rejected
- waiting
- unfinished

### price_status
- edited
- expire
- available

### transaction_status
- complete
- awaiting_payment
- illega
- canceled
- rejected

### inventory_status
- accepted
- illega
- canceled
- rejected

### inventory_change_type
- 1 = decrease
- 2 = increase


### offer_id
- 1 = sell
- 2 = buy
### Date type :
**unix_time**

like : ` 1554081890 `


### user auth
with phone and sms :)



## Code

مسیر فایل های مرتبط با ساخت دیتابیس
```project_root/database/migrations/*.php```

[اطلاعات بیشتر...](https://laravel.com/docs/5.8/migrations#creating-columns)





