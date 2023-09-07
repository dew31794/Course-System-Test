# 選課系統API TEST

## 需求版本

<pre>
PHP 7.3+
MariaDB 10.4
Laravel 8+
</pre>

## 如何安裝

1. Clone this repository
2. `composer install`
3. `cp .env.example .env`  修改資料庫設定 DB_DATABASE、DB_USERNAME、DB_PASSWORD
4. `php artisan key:generate`
5. `php artisan migrate --seed`  建立資料庫及現成資料
6. 執行專案 `php artisan serve`


## 瀏覽Swagger API 文件頁面
http://127.0.0.1:8000/api/documentation

![image](https://github.com/dew31794/Course-System-Test/blob/main/public/markdown/upload_087a3d054a034c84970f9bac2bcbd0cf.png)

若出現上面狀況，請確認 `專案/storage/api-docs/api-docs.json` 檔案是否存在
若沒有，請下產生文件指令 `php artisan l5-swagger:generate`

結果如下
![image](https://github.com/dew31794/Course-System-Test/blob/main/public/markdown/upload_ce3aef7d237fa6353783ff3dbcfa700d.png)

## 講師與學生及課程相關資料表欄位
路徑：`專案/database/migrations`

|  **資料表名稱**   |    **註解**    |
|:-----------------:|:--------------:|
|      courses      |   課程資料表   |
|     lecturers     |   講師資料表   |
| lecturer_accounts | 講師帳密資料表 |
|  select_courses   | 選課清單資料表 |
|     students      |   學生資料表   |

## Testing
測試檔案
* 路徑：`tests/Feature/CourseTest.php`
* 路徑：`tests/Feature/CLecturerTest.php`

執行指令
```
$ php artisan test
```
![](https://github.com/dew31794/Course-System-Test/blob/main/public/markdown/upload_ba314d1f24a8724c6a0902bbf326846f.png)
