# Test RuNetSoft
В базе хранятся  товары (автомобильные шины), написать скрипт, который разобьет шины по характеристикам.  Ниже представлена схема, как из названия получаются характеристики.

Nokian Hakkapeliitta R2 SUV 205/70 R15 100R TT  Летние
Nokian Hakkapeliitta R2 SUV 225/60 R17 99R XL Run Flat TT Зимние (шипованные)
1. __ - бренд *
2. __ - модель *
3. __ - ширина *
4. __ - высота *
5. __ - конструкция *
6. __ - диаметр *
7. __ - индекс нагрузки *
8. __ - индекс скорости *
9. __ - характеризующие аббревиатуры
10. __ - ранфлэт
11. __ - камерность
12. сезон *

\* - отмечены обязательные характеристики, если их нет, то товар помечается как некорректный, остальные могут быть или нет.

## Installation
```bash
docker-compose up -d
docker exec -it php-fpm composer install
````

### Run migrations
```bash
docker exec -it php-fpm php artisan migrate
```

## Run unit tests
```bash
docker exec -it php-fpm composer check
```
## API

Upload file and parse data with queue:

```bash
curl --location --request POST 'http://localhost:8080/products/import' \
--header 'Content-Type: multipart/form-data' \
--header 'Accept: application/json' \
--form 'file=@test.txt'
```
