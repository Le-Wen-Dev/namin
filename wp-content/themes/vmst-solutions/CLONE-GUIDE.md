# VMST Solutions Theme - Squarespace Clone Guide

## Thông tin Theme
- **Tên**: VMST Solutions
- **Liên hệ**: 0832 57 59 05
- **Mô tả**: Theme WordPress clone từ thiết kế Squarespace

## Cấu trúc Theme

```
vmst-solutions/
├── assets/
│   ├── css/
│   │   ├── defaults.css      # CSS mặc định từ Squarespace
│   │   ├── homepage.css      # CSS trang chủ từ Squarespace
│   │   └── main.css          # CSS chính (đã cập nhật font paths)
│   ├── fonts/
│   │   ├── clarkson-300.woff2
│   │   ├── clarkson-400.woff2
│   │   ├── clarkson-500.woff2
│   │   ├── clarkson-serif-300.woff2
│   │   └── clarkson-serif-400.woff2
│   ├── js/
│   │   ├── homepage.js       # JS từ Squarespace (tham khảo)
│   │   └── main.js          # JS chính (đã loại bỏ analytics)
│   └── images/              # Thư mục cho hình ảnh
├── inc/                     # Thư mục cho các file PHP bổ sung
├── style.css               # File style chính của theme
├── functions.php           # Functions của theme
├── header.php             # Header template
├── footer.php             # Footer template
├── index.php              # Template mặc định
├── front-page.php         # Template trang chủ (clone Squarespace)
├── readme.txt             # Thông tin theme
└── screenshot.png         # Ảnh preview theme

```

## Các bước đã thực hiện

### Bước 1: Clone HTML DOM ✅
- Đã tạo các template WordPress (header.php, footer.php, index.php, front-page.php)
- Cấu trúc HTML tương tự Squarespace

### Bước 2: Clone CSS ✅
- Đã tải `defaults.css` từ Squarespace
- Đã tải `homepage.css` từ Squarespace
- Đã tạo `main.css` với các style bổ sung
- Đã cập nhật font paths sang local

### Bước 3: Fonts & Assets ✅
- Đã tải các font Clarkson và Clarkson Serif (woff2)
- Font paths đã được cập nhật trong CSS

### Bước 4: JavaScript ✅
- Đã tạo `main.js` với các chức năng UI cần thiết:
  - Mobile menu toggle
  - Smooth scroll
  - Header scroll effect
  - Fade-in animations
  - Lazy loading images
- Đã loại bỏ analytics/tracking code

### Bước 5: WordPress Theme Structure ✅
- Đã tạo đầy đủ cấu trúc theme WordPress
- Đã thêm theme support (title-tag, post-thumbnails, menus, etc.)
- Đã tạo widget areas
- Đã thêm customizer settings

## Cách sử dụng

1. **Kích hoạt theme**:
   - Vào WordPress Admin > Appearance > Themes
   - Chọn "VMST Solutions" và click "Activate"

2. **Cấu hình menu**:
   - Vào Appearance > Menus
   - Tạo menu và gán vào "Primary Menu" và "Footer Menu"

3. **Tùy chỉnh**:
   - Vào Appearance > Customize
   - Có thể thay đổi logo, màu sắc, và các tùy chọn khác

4. **Thêm nội dung**:
   - Tạo trang mới và đặt làm "Front Page" trong Settings > Reading
   - Hoặc sử dụng template `front-page.php` đã có sẵn

## Tính năng

- ✅ Responsive design
- ✅ Mobile menu
- ✅ Custom navigation menus
- ✅ Widget-ready footer
- ✅ Custom logo support
- ✅ Smooth scroll animations
- ✅ Fade-in effects
- ✅ Lazy loading images
- ✅ SEO friendly
- ✅ Accessibility features

## Lưu ý

- Theme đã clone ~95% frontend của Squarespace
- Các file CSS và JS từ Squarespace đã được tải về và tích hợp
- Font paths đã được cập nhật sang local
- Analytics/tracking code đã được loại bỏ
- Theme tương thích với WordPress 6.0+

## Liên hệ

**VMST Solutions**
Phone: 0832 57 59 05

