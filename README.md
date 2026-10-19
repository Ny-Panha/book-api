# Book Management RESTful API (BBU Assignment)

Laravel API CRUD សម្រាប់ Tables ទាំង ៤ តាម ERD៖
- `tblAuthor`
- `tblBookType`
- `tblBook`
- `tblBookAuthor`

---

## 📁 រចនាសម្ព័ន្ធ Project (Project Structure)
- **Migrations**: `database/migrations/`
  - `..._create_tbl_author_table.php`
  - `..._create_tbl_book_type_table.php`
  - `..._create_tbl_book_table.php`
  - `..._create_tbl_book_author_table.php`
- **Models**: `app/Models/` (`Author.php`, `BookType.php`, `Book.php`, `BookAuthor.php`)
- **Controllers**: `app/Http/Controllers/` (`AuthorController.php`, `BookTypeController.php`, `BookController.php`, `BookAuthorController.php`)
- **Routes**: `routes/api.php`
- **Postman Collection**: `Book_API_Postman_Collection.json`

---

## 🚀 របៀបតម្លើង និង Run (Setup & Run)

### ១. តម្លើង dependencies
```bash
composer install
```

### ២. កំណត់ Database (.env)
បើក file `.env` ហើយផ្ទៀងផ្ទាត់:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_db
DB_USERNAME=root
DB_PASSWORD=
```

### ៣. Run Migrations & Seeders (ទិន្នន័យគំរូ)
```bash
php artisan migrate --seed
```

### ៤. Start Laravel Server
```bash
php artisan serve
```
Server នឹងដើរលើ: `http://127.0.0.1:8000`

---

## 📮 ការ Test លើ Postman & Record Video (Step 7)
1. បើកកម្មវិធី **Postman**
2. ចុចប៊ូតុង **Import** (នៅខាងឆ្វេងលើ)
3. ជ្រើសរើស file `Book_API_Postman_Collection.json` ក្នុង folder នេះ
4. ពេល import រួច វានឹងចេញ requests ទាំង ២០ (CRUD លើ tables ទាំង ៤) ស្រេច
5. ចុច `Win + Alt + R` (លើ Windows) ដើម្បី record វីដេអូពេលចុច Test (GET, POST, PUT, DELETE)

---

## 📦 Push ឡើង GitHub ឬ Zip (Step 8)
```bash
git init
git add .
git commit -m "Initial Laravel Book API assignment"
git branch -M main
git remote add origin <URL_REPO_GITHUB_របស់_NHA>
git push -u origin main
```
