yii2-Nocaptcha recaptcha
========================
Nocaptcha recaptcha integration for yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

   Add

    ```
    "repositories":[
            {
                "type": "git",
                "url": "https://github.com/bhanuagarwal/yii2-nocaptcha-recaptcha.git"
            }
        ],
    ```

    Either run

    ```
    php composer.phar require --prefer-dist sprytechies/yii2-nocaptcha-recaptcha "dev-master"
    ```

    or add
    
    ```
    "sprytechies/yii2-nocaptcha-recaptcha": "dev-master",
    ```

    to the require section of your `composer.json` file.

* [Register for an reCAPTCHA API keys](https://www.google.com/recaptcha/admin#createsite).

* Add `NoCaptchaValidator` in your model, for example:

```php
public $verifyCode;

public function rules()
{
  return [
      // ...
       [['verifyCode'], \sprytechies\nocaptcha\NoCaptchaValidator::className(),'secret'=>'your secret key']
  ];
}
```

or just

```php
public function rules()
{
  return [
      // ...
      [[], \sprytechies\nocaptcha\NoCaptchaValidator::className(), 'secret' => 'your secret key']
  ];
}
```

Usage
-----
For example:

```php
<?= $form->field($model, 'verifyCode')->widget(
    \sprytechies\nocaptcha\NoCaptcha::className(),[
     'widgetOptions' =>['data-sitekey' => 'your site key'
    ]
]) ?>
```

Resources
---------
* [Google reCAPTCHA](https://developers.google.com/recaptcha)