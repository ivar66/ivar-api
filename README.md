# ivar-api 后端接口

```shell
git clone git@github.com:ivar66/ivar-api.git

composer install

cp .env.example .env

#修改数据库配置
CREATE DATABASE IF NOT EXISTS ivar_cms;

php artisan migrate

#生成默认用户
php artisan db:seed --class=InitUserSeeder

# 生成jwt token
php artisan jwt:secret
```

