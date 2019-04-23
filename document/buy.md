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

- 1 -  دریافت تمام پیشنهاد های جدول فروش
- 2 - دریافت یک پیشنهاد براساس آی‌دی
- 3 - دریافت پیشنهادات براساس کاربر
- 5 - دریافت پیشنهادات براساس زمان 


### نکات :
- این مستند حاوی مسیر‌های فرعی و برخی توضیحات نسبت به نحوه دریافت اطلاعا از سرور می‌باشد
- هر یک از شماره ها بر اساس عنوانشون دارای یک تابع می باشند که در فایل روتر مشخص است مثال
<dt>

1 - [by status](#3)  : function = `status`  in buy file

</dt>

- هریک از توابع متانسب با اسمشان یک تابع در همین فایل برای دریافت اطلاعات از دیتابیس دارند که اگر نیاز به توضیحاتی در مورد تابع باشد به صورت کامنت درون کد و یا در بخش مربوط قرار می‌گیرد
</dl>

---

### 1
by nothing :D
- Query Address : `/get/buy/`

- Quert body :
```
  {
    limit
    desc
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
        start_time
        end_time
    }
```


### 4 
by TimeStamp
- Query Address : `/get/buy/timestamp/`

- Query Body : `Get`
```  
    {
        start_time*
        end_time
        user_id
    }
```
<dl>

اگر `end_time` وارد نشود برنامه زمان کنونی را در نظر می گیرد.

</dl>

#### start_time and end_time
  - unix_time like : ` 1554081890 `


---
---

## Set
<dl>

نکته در مورد `hash`

فعلا غیرفعال هست البته که می تونید ست کنید ولی تست نشده چون که به من گفتند فقط قرارش بده و غیرفعال باشه.

</dl>

- Query Address: `set/buy`

- Query Body: `Post`
```
{
    user_id*
    quantity*
    price*
    hash
}
```

- hash :
<dl>

برای این بخش باید مقادیر بالا بجز `hash` را طی فرایند زیر رمزگذاری کنید.

ارسال این مورد برای از بین بردن امکان اضافه کردن دیتا‌های اشتباهی از سوی کاربر الزامیست.

</dl>

- hash method: `AES-256-CBC`
- hash key   : 
  
  made with: \
  ```openssl_random_pseudo_bytes(16);```
- hash IV: 

    made with: \
    ```openssl_random_pseudo_bytes(16);```

- sample with php :
  ```
    $array = [
      'user_id'  => 1,
      'quantity' => 550,
      'price'    => 1.5
    ];
    $enc_name = openssl_encrypt(
    json_encode($array),  // padded data
    'AES-256-CBC',        // cipher and mode
    $encryption_key,      // secret key
    0,                    // options (not used)
    $iv                   // initialisation vector
    );
  ```
  TIP : hold Key and IV in a define variable be secret :)\
  TIP : array must convert to json...
----

## Update

<dl>

نکته در مورد `hash`

فعلا غیرفعال هست البته که می تونید ست کنید ولی تست نشده چون که به من گفتند فقط قرارش بده و غیرفعال باشه.


</dl>


- Query Address: `update/buy`

- Query Body: `Post`
```
{
    id*
    new_quantity*
    new_price*
    hash
}
```


<dl>

خب کارکرد این بخش خیلی سادس..

اول باید ایدی یوزر رو بدست بیاریم..

خب یه کوئری می زنیم که توی تابع 

db_update 

می تونید مشاهده کنید.

دوم باید اون پیشنهاد با اون ایدی که درخواست ویرایشش داشته شده حذف بشه.

سوم یه درخواست اضافه کردن مقدار جدید وارد می کنیم.

</dl>