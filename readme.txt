Cách cài đặt App
- Coppy thư mục dự án vào thư mục htdocs
- Chạy lệnh: php artisan migrate
- Chạy lệnh: php artisan db:seed
- Nếu trên nền Linux hoặc MACOS thì chạy lệnh sau:
    chmod -R 777 storage đẻ cấp quyền truy cập cho thư mục storage.
    chmod -R 777 bootstrap/cache để cấp quyền truy cập cho thư mục bootstrap.

Cấu trúc CSDL cơ bản của hệ thống:
- CategoriesBlog
- CategoriesProduct
- Products
- Blogs
- Articles
- Comments
- ImageProducts
- CustomProperties
- Contacts
- Linked
- Ratting
- Slider
- User
- Orders
- OrderDetails
- InfoOfPage
- StateOrder
- TokenAPI
- Menus
- Settings

Cấu trục hệ thống cơ bản
- Cấu trúc cơ bản của hệ thống sử dụng Repositories Pattern để xây dựng CURD cho các chức năng cơ bản.
- Việc truy vấn dữ liệu sẽ được viết chủ yếu trong Model, controller chỉ xử lý Bussiness và logic.
- Sử dụng Repositỏy pattern sẽ tránh việc lặp lại code ở Controller và tránh việc code truy vấn bị rải rác ở khắp nơi trong controller
- View chỉ xuất dữ liệu và xử lý logic nghiệp vụ đơn giản.

Về phía quản trị
- Hệ thống được viết với model và tối ưu lệnh truy vấn cho tất cả các DBMS
- Hệ thống chia ra làm 3 luồng cho việc quản lý
- Hệ thống 1 dành cho Sản phẩm: CategoriesProduct - Product - ImageProduct - Ratting - CustomProperties - Order - OrderDetails - StateOrders
- Hệ thống 2 dành cho Blog: CategoriesBlog - Blogs- Comments
- Hệ thống 3 dánh cho Article
- Ngoài ra các thành phần khác như Info, TokenAPI, Slider, Users là 1 hệ thống riêng.
- Các hệ thống chính sẽ nằm trong phần System Elements của sidebar
- Các hệ thống phụ sẽ nằm ở phần Orther Elelemts

Các chức năng nâng cao
- Chức năng ratting: đánh giá sản phẩm dựa vào số sao của người dùng.
- Chức năng chèn hình ảnh vào bài viết: sử dụng ckeditor và ckfinder để chèn thêm hình ảnh vào ô textarea.
- Chức năng comment.

Chức năng thống kê:
- Thống kê tổng số(sản phẩm, đơn hàng, liên hệ, người dùng)
- Vẽ biểu đồ thống kê(Biểu đồ đường, biểu đồ tròn, biểu đồ ngang)
- 8 người dùng mới nhất
- Phản hồi mới nhất
- 7 Đơn hàng mới nhất
- Thống kê lưu lượng(Tỷ lệ đơn hàng chuyển thành công, tỷ lệ bình luận có phản hồi, tỷ lệ check phản hồi, tỷ lệ đơn hàng bị hủy)

Quản lý phân quyền trong dự án: sử dụng package Spatie Laravel permission
- Tất cả các tài khoản quản trị phía backend đều sẽ có 1 Role(quyền hạn) là ADMIN
- Chỉ có 1 tài khoản được quyền cao nhất SUPER_ADMIN(Role)
- Mỗi một tài khoản(account) sẽ chỉ được cấp nhiều vai trò với nhiều quyền hạn.
- Tuy được cấp nhiều vai trò với nhiều quyền hạn nhưng không được phép lặp lại quyền hạn thuộc vai trò được cấp.
Ví dụ:
  - Tài khoản nguyenlongit95 được cấp vai trò(Role) là SUPER_ADMIN và được cấp quyền hạn là all. Bây giờ thì tài khoản này
  sẽ không được cấp thêm 1 quyền hạn all từ một vai trò(Role) nào nữa. Bây giờ tài khoản có vai trò SUPER_ADMIn vẫn có thể
  nhận thêm vai trò khác như(Writer) với các quyền hạn như: list-blog, edit-blog, delete-blog, add-blog.
- Mỗi 1 Role sẽ có thể được cấp nhiều quyền hạn nhưng tránh việc trùng lặp quyền hạn với nhau. Nên xem kỹ quyền hạn với vai trò
trước khi phân quyền cho tài khoản.

Quản lý và sử dụng các APIs(Việc quản lý và xác thực các APIs sử dụng Passport và phần mềm postman để kiểm tra thử)
- Cài đặt Pasport và cấu hình API
- Route của các API sẽ được viết trong routes/api.php
- Mặc định tiền tố URL sẽ có api/...

Tích hợp cổng thanh toán trực tuyến:
- paypal
- OnePay
- Ngân lượng
Sử dụng factory pattern để giảm thiểu sự khởi tạo đối tượng và tăng tính giằng buộc của các lớp khởi tạo
Tại đây sẽ tạo ra các instance phù hợp với yêu cầu của người dùng khi mua hàng.
Dễ dàng cho việc mở rộng các cổng thanh toán về sau này
