## *Mục lục*
- [1. Create folder](#1-create-folder)
- [2. Import DB in mySQL](#2-import-db-in-mysql)
- [3. Run](#3-run)
# 1. Create folder
- Vào thư mục Xamp tìm thư mục `htdocs`
- `Tạo` thư mục để chứa project
- `Vào` thư mục đã tạo gõ `cmd` trên thanh đường dẫn
- Nhập các câu lệch sau vào `cmd` tạo thư mục:
    - Ví dụ mới tạo xong thư mục có tên là: `Xemxongxoa`
    - `git init`
    ```cmd
    E:\Xamppp_Nam4\htdocs\Xemxongxoa>git init
    ```
    - `git clone https://gitlab.codecomplete.jp/intern.baopham/phpbasic.git`
    ```cmd
    E:\Xamppp_Nam4\htdocs\Xemxongxoa>git clone https://gitlab.codecomplete.jp/intern.baopham/phpbasic.git
    ```
# 2. Import DB in mySQL
- Bật `Apache` và `MySQL` trong mySQL
- Mở project đã clone về và mở thư mục `basic_php.sql` trong folder `phpbasic/config/basic_php.sql`
- Và chạy nó trong `SQL query` trong mySQL

# 3. Run
- Ví dụ trên là đã tạo thư mục `Xemxongxoa` để chứa project
- Mở trình duyệt và nhập url này vào: 
    - `http://localhost/Xemxongxoa/phpbasic/view/index.php?controller=login&action=login`
- Sử dụng tài khoản đã tạo sẵn để đăng nhập như:
    - bao@gmail.com
    - 111
