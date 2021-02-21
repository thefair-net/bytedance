<h1 align="left"><a href="#">ByteDance SDK</a></h1>

📦 字节跳动PHP SDK 抖音小程序、头条小程序开发组件。PHP SDK for bytedance (douyin, tiktok, toutiao)


## Requirement

1. PHP >= 7.1
2. **[Composer](https://getcomposer.org/)**
3. openssl 拓展


## Installation

```shell
$ composer require "surpaimb/bytedance" -vvv
```

## Usage

基本使用（以服务端为例）:

```php
<?php

use Surpaimb\ByteDance\Factory;

$options = [
    'app_id'    => 'wx3cf01239eb0exxx',
    'secret'    => 'f1c242f4f28f735d4687abb469072xxx',
    // ...
];

$app = Factory::make($options);

$session = $app->auth->session($code);
```


## Documentation

Coming soon

## Integration



## Contributors


## License

MIT

## Special Thanks
[@overtrue](https://github.com/overtrue)

