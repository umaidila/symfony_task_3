## phpstan
Проверялась директория src, где хранятся контроллеры и сущности

Проверка на уровне строгости 0:

![IuetfsySCfA](https://user-images.githubusercontent.com/87616197/151139072-f420b6ba-6e6b-47c8-94bf-9745e1666cb9.jpg)

После исправления ошибок:

![baxCvl1-A7I](https://user-images.githubusercontent.com/87616197/151139187-85cacbc8-d793-4891-be40-dd07f2515f16.jpg)

Поднимаем уровень до 2: 

![iwW8VqSMldQ](https://user-images.githubusercontent.com/87616197/151139326-615c55f5-9ff3-4831-9f53-ab5cd10d9a4d.jpg)

Ошибки исправлены:

![XteCg3YmO6o](https://user-images.githubusercontent.com/87616197/151139793-5d0d1747-3b43-4ac4-914b-b50503d8c23b.jpg)

Далее ошибок нет вплоть до уровня 5:

![tmO12M6nw8s](https://user-images.githubusercontent.com/87616197/151139454-45d5d31e-e796-42eb-9f73-b80e7015ac0b.jpg)

На уровне 6 ошибки появляются, далее решил не исправлять

![fwCnpvkVMWo](https://user-images.githubusercontent.com/87616197/151139752-a2cf7b11-9f41-4a31-973d-75fad6b4b6ca.jpg)

## phpcs

![KuawRN5_Cco](https://user-images.githubusercontent.com/87616197/151140080-894f4bc0-495f-4c23-ad79-020bd6733222.jpg)

Исправлены с помощью phpcbf

## phpcbf

![w4ogPqaFKCQ](https://user-images.githubusercontent.com/87616197/151152333-91f0571a-4a88-4198-b8bb-49d56283b24f.jpg)

Проверка phpcs после автоисправления (остались только warnings о слишком длинных строках)

![xEnxWrC0OMM](https://user-images.githubusercontent.com/87616197/151152493-e88a1427-0325-4ce7-b392-e82d24b927a9.jpg)

## php-cs-fixer

![TjipEwhUFgs](https://user-images.githubusercontent.com/87616197/151153441-3460c45f-ae87-4823-bb1c-c7bcdbbbe40d.jpg)

## phpmd

![4GqvruKOlCo](https://user-images.githubusercontent.com/87616197/151153691-1c9530b6-cde8-4dad-bc21-729609da57e1.jpg)

Ошибка об отсустивии импорта класса Exception, хотя он и не нужен (берется из глобальных имен), исправлять не стал

## ecs

![LTjBL0o_URU](https://user-images.githubusercontent.com/87616197/151153837-49992ae2-30d0-4e09-9164-373b60d019f5.jpg)

Коммит со всеми исправлениями:
https://github.com/umaidila/symfony_task_3/commit/5a0c4c1d77ad2a00acf5d889448364e5f707fe00
