<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Nhúng các file thư viện từ thư mục src
require "src/PHPMailer.php";
require "src/SMTP.php";
require "src/Exception.php";

$mail = new PHPMailer(true);

try {
    // $mail->SMTPDebug = 2; // Bật debug nếu muốn xem chi tiết
    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Cấu hình tài khoản gửi
    $nguoigui = 'phuongntk.25ite@vku.udn.vn'; 
    $matkhau = 'ykzgbevidfornirr';             // Mật khẩu ứng dụng 16 ký tự
    $tennguoigui = 'Phương';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($nguoigui, $tennguoigui);

    // Chuỗi chứa danh sách các địa chỉ email nhận (phân cách bởi dấu phẩy)
    $recipients = "phuongntk.25ite@vku.udn.vn, anhptm.25ite@vku.udn.vn";
    
    // Tách chuỗi danh sách email thành mảng
    $email_array = explode(",", $recipients);

    $to_name = "Bạn";

    // Vòng lặp duyệt qua từng email trong mảng để thêm vào danh sách người nhận
    foreach ($email_array as $email) {
        $to = trim($email); // Xóa khoảng trắng thừa (nếu có)
        $mail->addAddress($to, $to_name);
    }

    $mail->isHTML(true);
    $mail->Subject = 'Gửi thư cho nhiều địa chỉ';
    $mail->Body    = '<b>Chào các bạn!</b><br>Đây là email gửi đồng thời cho nhiều địa chỉ từ bài Lab 8.';

    // Bỏ qua kiểm tra chứng chỉ SSL trên Localhost
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));

    $mail->send();
    echo 'Đã gửi mail thành công cho tất cả các địa chỉ!';

} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>