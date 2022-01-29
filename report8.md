# Lab 8

Хуки находятся в каталоге /githooks

Клиентский хук pre-commit, форматирующий код средством phpcbf (должно быть установлено на клиенте)

Тестовый контроллер до коммита:

![tRrr76MuLRI](https://user-images.githubusercontent.com/87616197/151657099-29a2a501-f739-41ff-bf89-0063b3a4b52d.jpg)

Вызываем коммит, выводится результат работы средства phpcbf

![8VICi2PCJOY](https://user-images.githubusercontent.com/87616197/151657117-879100c2-8cb6-42b5-87da-4936aab6223e.jpg)

Контроллер после коммита:

![0urHhFiBumM](https://user-images.githubusercontent.com/87616197/151657135-d04eded4-6786-4257-b905-c4ac749f93cf.jpg)

Клиентский хук commit-msg, проверяющий сообщения коммита на соответствия стандарту

Неверное сообщение:

![_AOyxp1xjg4](https://user-images.githubusercontent.com/87616197/151657256-4bdd5b12-789b-41da-a56c-33a8cb85b893.jpg)

Верное:

![Le_LVULZceY](https://user-images.githubusercontent.com/87616197/151657272-3288d4aa-d820-4e05-8f91-bd614ad141a8.jpg)

Серверный хук post-receive, выводящий "Hello world!" после пуша на сервер

![MHfXR4LTVQ4](https://user-images.githubusercontent.com/87616197/151657311-0cbe6020-9858-4c8f-a0a1-0f93a77e096f.jpg)

