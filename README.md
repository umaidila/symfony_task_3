# rest API with JWT auth

Сначала попытаемся получить доступ без токена:
![alt text](screens/1.png )​
Не получилось, регистрируем нового юзера:  
![alt text](screens/2.png )​
Получаем токен по введенным данным:
![alt text](screens/3.png )​
Используя токен, получаем список задач (пока пустой):
![alt text](screens/4.png )​
Добавим пару задач в список:
![alt text](screens/5.png )​
![alt text](screens/6.png )​
Выведем обновленный список:
![alt text](screens/7.png )​
Удалим первую задачу, и отредачим вторую:
![alt text](screens/8.png )​
![alt text](screens/9.png )​
Посмотрим на изменения:
![alt text](screens/10.png )​
Теперь создадим нового юзера и получим для него токен:
![alt text](screens/11.png )​
![alt text](screens/12.png )​
Выведем список задач, он пуст, т.к. задачи привязаны к другому юзеру
![alt text](screens/13.png )​
Получить, удалить и отредачить по id также не удаётся
![alt text](screens/14.png )​
![alt text](screens/15.png )​
![alt text](screens/16.png )​
Добавим задачу для нового юзера, она корректно отображается
![alt text](screens/17.png )​
![alt text](screens/18.png )​
