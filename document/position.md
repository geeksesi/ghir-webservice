<style>
dl{direction:rtl; text-align:right}
dt{direction:ltr; text-align:left}
</style>
<center>به نام خداوند جان و خرد</center>

<dl>

## خرید و فروش‌های انجام شده


<dt>

## Get

</dt>

- * براساس هیچ چیز 
- ۱- بر اساس `id`
- ۲- بر اساس `position_type`
- ۳- بر اساس `user_id` || `corr_id`
- ۴- بر اساس `position_timestamp` || `position_old_timestamp`


</dl>


### * :

<dl>
دریافت تمام اطلاعات
</dl>

- Query Address : `/get/position`

- Query Body :
```
    {
        limit
        desc
    }
```

### 1 :
by id

- Query Address : `/get/position/id`

- Query Body :
```
    {
        id
    }
```



### 2 :
by position_type 
- buy
- sell

- Query Address : `/get/position/type`

- Query Body :
```
    {
        type*
        limit
        desc
    }
```


### 3 :
by user (buyer or seller)

- Query Address : `/get/position/user`

- Query Body
```
    {
        seller_id*
        buyer_id*
        limit
        desc
    }
```

<dl>

نکته : باید یکی از فیلد های ستاره دار حتما وارد شود.

</dl>


### 4 :
by timestamp (order timestamp or position time stamp)

- Query Address : `/get/position/timestamp`

- Query Body
```
    {
        order_start*
        order_end*
        position_start*
        position_end*
        limit
        desc
    }
```

<dl>

حتما باید یکی از بازه‌های `order` یا `position` وارد شود

اگر هر دو بازه زمانی وارد شود فقط نتایج اشتراک دو بازه نمایش داده خواهد شد.

</dl>


## Set

