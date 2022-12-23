Реализация шаблона CRUD
========================
Задание
------------------------
Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD.
Система предназначена для анонимного общения в сети интернет.

Интерфейс системы представляет собой веб-страницу с лентой заметок, отсортированных в обратном хронологическом порядке и форму добавления новой заметки. В ленте отображаются последние 100 заметок.

Возможности пользователей:
- добавление текстовых заметок в общую ленту
- реагирование на чужие заметки(лайки)
- добавление комментариев к чужим заметкам
- "раскрывающиеся" комментарии

Ход работы
------------------------

- Разработать пользовательский интерфейс
- Описать сценарии работы
- Описать API сервера и хореографию
- Описать структуру БД и алгоритмы обработки данных
- Написать программный код
- Удостовериться в корректности кода

#### [1. Пользовательский интерфейс](https://www.figma.com/file/jorvnPiynwoiiXGqKg9q6U/Untitled?node-id=0%3A1&t=82ewv1XJ7ANE6QTD-1)

#### 2. Пользовательский сценарий работы
Пользователь попадает на главную страницу **index.php**, вводит любое текстовое сообщение. В случае корректного ввода данных, его сообщение появится в ленте в обратном хронологическом порядке. 
Пользователи могут ставить лайки на понравившиеся записи и комментировать их. Для этого необходимо ввести свой комментарий в поле под записью и нажать кнопку **Написать комментарий**. Для просмотра оставленных комментариев следует нажать кнопку **Посмотреть комментарии**.

#### 3. API сервера и хореография
[Добавление заметки](https://sequencediagram.org/index.html#initialData=IYYwLg9gTgBI+CCD4QQ3CCBkQQ7CAMEwggGEEEIghWEFQCgAHYKMASxErIDswZBCEH0AEQTNooxVDHA1AFoAfC3ZsAXIH4QZOix5CKGJkwJALCCAOEFww02QDwg+XIC4QQMIgXUFQBuwMAFNmbDqy485-RQB5BgsU4kJARhBAXhAsJHwgoMBpEEBOEBhKOgATWwAPADoSAAsSGEBBEBgQ1VjdA2MEaK4iJItKazsHcWciIA)  

[Реакция](https://sequencediagram.org/index.html#initialData=IYYwLg9gTgBI+CCD4QQ3CCBkQQ7CAMEwggGEEEIghWEFQCgAHYKMASxErIDswZBCEH0AEQTNooxVDHA1AFoAfC3ZsAXIH4QZOix5CKGIEEQXNkyAOEFwwk2QJwggLhAuoKgDdgYAKbM2HVlx5z+igDyDBYuxISBGEEC8IFhI+H5+gNIgejCUdAAmlgAeAHQkABYkKjC+AZhBIaGAPCAwBsgagOIg+KqYCAW6hlhcRLEmlOZWNuL23LJ8CkKitpIyvPICSgiq6kiA8iD42kV5ecFqrBp6xuDNFtaenJ1DzqhuHv2s3v6BwWERUbGJKWnKGWfZF-kahVULfksak3ka9Y11i0tscgA)  

[Просмотр комментариев](https://sequencediagram.org/index.html#initialData=IYYwLg9gTgBI+CCD4QQ3CCBkQQ7CAMEwggGEEEIghWEFQCgAHYKMASxErIDswZBCEH0AEQTNooxVDHA1AFoAfC3ZsAXIH4QZOix5CKGIF4QbIDYQQBwggHhBs+XDEBcIMoRSDgYRAYgFhAkgeRAYU1gkCCIFoS5W2Qwi1b8y3NisGviYXKBUAG7AYACmzGwcrFw8cvyKADyCgmKJEgiAjCDGmEh+yoDSIICcIDCUdAAmMQAeAHQkABYkME6dUhpOBt5evv6BwZiGMGjYvrgG+FxE9eGUUbHx4klAA)  


#### 4. Структура базы данных

 Таблица *messages*
| Название | Тип | NULL | Описание |
| :------: | :------: | :------: | :------: |
| **id** | INT  | NO | Автоматический идентификатор поста |
| **text** | TEXT | NO | Текст заметки |
| **likes** | INT | NO | Количество лайков |
| **time** | DATETIME | NO | Дата создания поста |

Таблица *comments*
| Название | Тип | NULL | Описание |
| :------: | :------: | :------: | :------: |
| **message_id** | INT  | NO | Идентификатор поста |
| **text** | TEXT | NO | Текст комментария |
| **time** | DATETIME | NO | Дата создания комментария |


#### 5. [Алгоритмы](https://viewer.diagrams.net/?tags=%7B%7D&highlight=0000ff&edit=_blank&layers=1&nav=1#R5Vpdb5swFP01eWyFzWce26Yf0rJpUidt68vkJW7wBhiB05D9%2BhmwwQaaMDWJu%2FaF2Jdrg4%2FPudd2mNhXcXGboTT8SJc4mkBrWUzs2QRCYDsB%2Fykt29riA1gbVhlZCqfWcE%2F%2BYGG0hHVNljjXHBmlESOpblzQJMELptlQltGN7vZII%2F2pKVrhnuF%2BgaK%2B9StZslBYgTdtb9xhsgrFowPo1zdiJJ3FSPIQLelGMdnXE%2Fsqo5TVpbi4wlEJnsSlbnfzzN3mxTKcsDENfnz87BEyd5K7p%2BL7I3G%2BzOcPZ7KbnG3liPGSAyCqNGMhXdEERdet9TKj62SJy24tXmt95pSm3Ai48RdmbCtmE60Z5aaQxZG4iwvCvinl72VX566ozQrRc1XZykrCsm3TqKworcpq26yqyXZ9mOSQ6Tpb4B3YAKd2LAFRWgp0bzGNMX8Qd8hwhBh50hmDBPFWjZ9oepFlaKs4pJQkLFd6%2FlwauIPQkOcIAgkFnQHL68z03hZ2oLXghfothtu70%2BfaNy%2FNULbCTLTTOlaQaU0VFYdp%2BenhFnyIgIfIfTqHPyj8EuAzu37aE4rWAlUTNB2c%2Fr1cGhyQDF0VbDv84AsZpk3Ev6LuvlfUHZOo%2B%2B8Vdc8k6qCHOuEAFudpmPbg34SE4fsUVaPe8HWODh3K03rl8UiKcgoElk84Y7jYjWZ%2F9DIEe3oIlhF9065BZEgO1dWHdSy4pm%2BNpXAkS0FgkqawDzvHbjorr5dWdb2prsGEAxQAaedlWF35Y2s3X2lyVV1d6cbLF1WZp10PxSW9k5952uCtzHEW0vjnmo%2Fyco8oDqGBzjIGWn0RAHhSFThvTQXOWBXYJlUwAHupgpr515L5DZlrkkNFFx0tXCpuU8F%2Fk0y390f70xL9zUV7byTPjQZ772DB%2FkIqown2Tcjn15muFV62ZLeVIExKwYevTAqgv1L8z7UQjI351vBMnUYMwbAYoBLba347FekbQrvKekZPCi%2FVBi%2Ff9Kb%2B%2BIqYdhThjlSEdzRFGBHA8PlfU9l5%2BneYba01VjcvlM0zh3q%2BTgNgn%2FZITg6%2FK0hHkRNQMhVUVlqNtJok4x5IjfJZdWEKxCtp9s66ECgvVvfjyc2PtaBxzImRn78CnYOpcaEPLEj%2B79QH7LEadk3mPjBw%2Ft1dCXr66q%2BvLOmsCW2myO1G3%2Flbc%2FIbG%2BA98F5bfvON5jfLVH5zT5TfXjY5A39SlNJQE5BK8nFpSEscI%2FMFx96KcZ6jFc5fgWzMpwv45nZKYOxWCRrdKoGj7ZX2HhpXmjg9%2BbtHw7ZvnPxmN0Va0rDO%2FXFfRRzmj5ST7ov%2B9esJt7t7dnZ%2FO9H1B9aOLycOtbeCx9lbjVTvgfdQBnNiNyy44HhhgVfbb7dqIrRfwNnXfwE%3D)

#### 6. HTTP запрос/ответ
**Запрос**  
Request URL: http://localhost/crud/index.php
Request Method: POST
Status Code: 200 OK
Remote Address: [::1]:80
Referrer Policy: strict-origin-when-cross-origin
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate, br
Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7
Cache-Control: no-cache
Connection: keep-alive
Content-Length: 150
Content-Type: application/x-www-form-urlencoded
Cookie: text=dimbrus%20skazal%20axyet%0D%0A; PHPSESSID=tjdf9k1fm7b06s0mjcf2m74log
DNT: 1
Host: localhost
Origin: http://localhost
Pragma: no-cache
Referer: http://localhost/crud/index.php
sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "Linux"
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36

**Ответ**
Connection: Keep-Alive
Content-Encoding: gzip
Content-Length: 1352
Content-Type: text/html; charset=UTF-8
Date: Fri, 23 Dec 2022 23:35:55 GMT
Keep-Alive: timeout=5, max=100
Server: Apache/2.4.52 (Ubuntu)
Vary: Accept-Encoding
#### 7. Значимые фрагменты кода
**Добавление комментариев(add_comment.php)**
```
$msg = $_POST["text"];
$id = $_POST["id"];

$link = mysqli_connect('localhost', 'newuser', 'password','oh_my_laba');
    if ($link == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    
    mysqli_set_charset($link, "utf8");
    $sql = "INSERT INTO comments (message_id, text, time) VALUES ($id, '$msg', NOW())";
    $result = mysqli_query($link,$sql);

    if ($result == false) {

        print("Произошла ошибка при выполнении запроса");

    }else{
        mysqli_close($link);
        header("Location: index.php", true, 303);
    }

```
**Изменение лайков(change_likes.php)**
```
    $link = mysqli_connect("localhost", "newuser", "password", "oh_my_laba");
    if ($link == false) {

        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());

    }

    mysqli_set_charset($link, "utf8");

    $id = $_POST['id'];
    $likes = $_POST['post_likes'];
    $likes++;
    $sql = "UPDATE messages SET likes=$likes WHERE id = $id";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    header("Location: index.php");

```

**Получение комментариев из бд для заметки(get_from_db.php)**
```
function get_comments($id){
    $link = connect(); 
    $sql = "SELECT * FROM comments WHERE message_id = $id ";
    $result = mysqli_query($link, $sql);
    if ($result == false) {

        print( "Произошла ошибка при выполнении запроса");

    }else
    mysqli_close($link);
    return $result;
}
```
