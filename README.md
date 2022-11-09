### Hexlet tests and linter status:
[![Actions Status](https://github.com/VaLeraGav/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/VaLeraGav/php-project-48/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/a5f903c3f592db3650ab/maintainability)](https://codeclimate.com/github/VaLeraGav/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/a5f903c3f592db3650ab/test_coverage)](https://codeclimate.com/github/VaLeraGav/php-project-lvl2/test_coverage)
![linter and tests](https://github.com/VaLeraGav/php-project-lvl2/workflows/linter%20and%20tests/badge.svg)


# Вычислитель отличий
Второй проект из четырёх, в рамках профессии PHP-программист на [Хекслет](https://ru.hexlet.io/professions/php).

## Описание проекта
Необходимо реализовать сравнение 2 файлов (форматов json, yml/yaml). Работатет с плоским и вложеными данными. Отчет строиться как в json, plain, stylish формате.

## Требование, установка и запуск
Наличие на компьютере PHP >= 7 и Composer.
```
$ sudo apt install php

$ git clone https://github.com/VaLeraGav/php-project-lvl2.git

$ make install
```

## CI приложжение

`$ bin/gendiff -h` - все возможности gendiff

`$ bin/gendiff -v`  - версия

`$ bin/gendiff <pathToFile1> <pathTofile2> [--format <fmt>]`  - получить 
различие в <fmt> формате

## Пример использования

### Сравнение файлов json и yaml/yml в формате по умолчанию stylish
[![asciicast](https://asciinema.org/a/I8YGArIAn9fxAxTj7xNLf4ox3.svg)](https://asciinema.org/a/I8YGArIAn9fxAxTj7xNLf4ox3)

[![asciicast](https://asciinema.org/a/PJlHF0XTJQxy4vG1gwk1JBYsv.svg)](https://asciinema.org/a/PJlHF0XTJQxy4vG1gwk1JBYsv)

### Сравнение файлов json и yaml/yml в формате stylish
[![asciicast](https://asciinema.org/a/UTS850TgHdX5pXKqOsmV53Ey9.svg)](https://asciinema.org/a/UTS850TgHdX5pXKqOsmV53Ey9)

### Сравнение файлов json и yaml/yml в формате plain
[![asciicast](https://asciinema.org/a/GBorRO2qB9KOYdSKLfyGYrwYi.svg)](https://asciinema.org/a/GBorRO2qB9KOYdSKLfyGYrwYi)

### Сравнение файлов json и yaml/yml в формате json
[![asciicast](https://asciinema.org/a/m1ol4r9ABcVbrHdV3440BrMDw.svg)](https://asciinema.org/a/m1ol4r9ABcVbrHdV3440BrMDw)
