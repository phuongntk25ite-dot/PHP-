<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Nhúng thư viện từ thư mục src
require "src/PHPMailer.php";
require "src/SMTP.php";
require "src/Exception.php";

$mail = new PHPMailer(true);

try {
    // $mail->SMTPDebug = 2; // Bật debug nếu muốn xem chi tiết kết nối
    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    
    // Cấu hình thông tin tài khoản gửi
    $nguoigui = 'phuongntk.25ite@vku.udn.vn'; 
    $matkhau = 'ykzgbevidfornirr';             // Mật khẩu ứng dụng 16 ký tự vừa tạo
    $tennguoigui = 'Phương';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Thiết lập người gửi và người nhận
    $mail->setFrom($nguoigui, $tennguoigui);
    $to = "anhptm.25ite@vku.udn.vn";            // Địa chỉ email người nhận
    $to_name = "Người Nhận";

    $mail->addAddress($to, $to_name);

    // Nội dung Email
    $mail->isHTML(true);
    $mail->Subject = 'Gửi thư từ php';
    
    $noidungthu = "<b>Chào bạn!</b><br>Chúc an lành!";
    $mail->Body = $noidungthu;
    
    // Đính kèm tệp 4.jpg (nếu có trong thư mục)
    if (file_exists("4.jpg")) {
        $mail->addAttachment("4.jpg", "picture");
    }

    // Bỏ qua kiểm tra chứng chỉ SSL (tránh lỗi kết nối trên XAMPP localhost)
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));

    $mail->send();
    echo 'Đã gửi mail xong';

} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>