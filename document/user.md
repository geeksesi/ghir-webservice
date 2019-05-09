<style>
dl{direction:rtl; text-align:right}
dt{direction:ltr; text-align:left}
</style>
<center>به نام خداوند جان و خرد</center>




<dl>



# کاربر


# دریافت اطلاعات

- * - دریافت لیست کاربران
- 1 - دریافت اطلاعات بر اساس آی‌دی
- 2 - دریافت اطلاعات بر اساس استاتوس کاربر

</dl>

### output : 

```
{
    id
    user_status
    name
    user_name
    phone_id
    user_credit
    account_id
    bank
    sheba
}
```

## *

- Query Address : `/get/user`
  Get Request

- Query Body : 
  ```
    {
        sort_by : id or credit, (can't both of them)
        limit
        Desc
    }
  ```

## 1 

- Query Address : `/get/user/id`
    Get Request

- Query Body : 
  ```
    {
        id*
    }
  ```

## 2

- Query Address : `/get/user/status`
  Get Request

- Query Body : 
  ```
    {
        status*
        sort_by : id or credit, (can't both of them)
        limit
        Desc
    }


<dl>

# احراز هویت

</dl>

- Query Address : `/get/user/auth`
  Post Request

- Query Body : 
  ```
    {
        hash* :
        {
            user_name*
            phone_number*
            password*
        }
    }

<dl>

یک آرایه جیسان با این محتویات به صورت رمزنگاری شده باید ارسال شود

نحوه رمزنگاری :

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
      'user_name'  => "geeksesi",
      'password' => "javadkhof",
    ];
    $enc_name = openssl_encrypt(
    json_encode($array),  // encode to json
    'AES-256-CBC',        // cipher and mode
    $encryption_key,      // secret key
    0,                    // options (not used)
    $iv                   // initialisation vector
    );
  ```
  TIP : hold Key and IV in a define variable be secret :)\
  TIP : array must convert to json...



<dl>

# اضافه کردن کاربر

</dl>

- Query Address : `/set/user/`
  Post Request

- Query Body : 
  ```
    {
        hash* :
        {
            name*
            user_name*
            password*
            phone_number*
            user_status = null
            user_credit = 0
        }
    }

<dl>

یک آرایه جیسان با این محتویات به صورت رمزنگاری شده باید ارسال شود

دقیقا مثل مثال بالا رمزنگاری می شود.

</dl>


<dl>

# بروزرسانی اطلاعات




</dl>

- Query Address : `/update/user/`
  Post Request

- Query Body : 
  ```
    {
        id*
        hash* :
        {
            name
            user_name
            password
            phone_number
            user_status
            user_credit
        }
    }

<dl>

یک آرایه جیسان با این محتویات به صورت رمزنگاری شده باید ارسال شود

دقیقا مثل مثال بالا رمزنگاری می شود.

هرکدام از مقادیری که در آرایه هش شده وارد شوند بروزرسانی خواهند شد

</dl>

