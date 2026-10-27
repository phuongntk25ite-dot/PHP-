<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Email tới bạn</title>
    <!-- Nhúng Bootstrap 4 để giao diện đẹp đúng mẫu trong Lab -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h2>Email tới bạn</h2>
    <form action="mail.php" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email người nhận">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="tieude" placeholder="Tiêu đề">
        </div>
        <div class="form-group">
            <textarea name="content" id="editor" class="form-control" rows="5" placeholder="Nội dung email"></textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>
</body>
</html>