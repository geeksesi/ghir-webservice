<style>
dl{direction:rtl; text-align:right}
dt{direction:ltr; text-align:left}
</style>
<center>به نام خداوند جان و خرد</center>
<dl>

# جدول فروش

</dl>

## Get

<dl>

- 1 -  دریافت انواع پیشنهاد های جدول فروش
- 2 - دریافت براساس آی‌دی
- 3 - دریافت پیشنهادات براساس کاربر
- 4 - دریافت پیشنهادات براساس شماره محصول
- 5 - دریافت پیشنهادات براساس زمان 
- 6 - دریافت تاریخچه یک پیشنهاد


### نکات :
- این مستند حاوی مسیر‌های فرعی و برخی توضیحات نسبت به نحوه دریافت اطلاعا از سرور می‌باشد
- هر یک از شماره ها بر اساس عنوانشون دارای یک تابع می باشند که در فایل روتر مشخص است مثال
<dt>

1 - [by status](#3)  : function = `status`  in buy file

</dt>
</dl>

---

### 1 
by status
- Query Address : `/get/buy/status`

- Query Body : `Get`  
```
    {
        status*
    }
```

### 2 
by id
- Query Address : `/get/buy/id/`

- Query Body : `Get`
```  
    {
        id*
    }
```

### 3 
by user_id
- Query Address : `/get/buy/user/`

- Query Body : `Get`
```  
    {
        user_id*
        product_id
        status
        start_time
        end_time
    }
```

### 4 
by product_id
- Query Address : `/get/buy/product/`

- Query Body : `Get`
```  
    {
        product_id*
        user_id
        status
        start_time
        end_time
    }
```

### 5 
by TimeStamp
- Query Address : `/get/buy/TimeStamp/`

- Query Body : `Get`
```  
    {
        start_time*
        end_time*
        product_id
        user_id
        status
    }
```

### 6 
History 
- Query Address : `/get/buy/History/`

- Query Body : `Get`
```  
    {
        id*
        start_time
        end_time
    }
```


---
---

## Set
<dl>



</dl>

- Query Address : `set/buy`

- Query Body : `Post`
```
{
    user_id*
    product_id*
    offer_value*
    offer_price*
    hash*
}
```

- hash :
<dl>

برای این بخش باید مقادیر بالا بجز `hash` را طی فریایند زیر رمزگذاری کنید.

ارسال این مورد برای از بین بردن امکان اضافه کردن دیتا‌های اشتباهی از سوی کاربر الزامیست.

</dl>

- hash method : `AES-256-CBC`
- hash key : 
  
  made with :\
  ```openssl_random_pseudo_bytes(16, true);```
- hash IV :

    made with :\
    ```openssl_random_pseudo_bytes(16, true);```

- sample with php :
  ```
    $array = [
      'user_id'=>1,
      'product_id'=>2,
      'offer_value'=>550,
      'offer_price'=>1.5
    ];
    $enc_name = openssl_encrypt(
    json_encode($array), // padded data
    'AES-256-CBC',        // cipher and mode
    $encryption_key,      // secret key
    0,                    // options (not used)
    $iv                   // initialisation vector
    );
    ```
  TIP : hold Key and IV in a define variable be secret :)\
  TIP : array must convert to json...
----