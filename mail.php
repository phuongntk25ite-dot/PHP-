<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Nhúng các file thư viện PHPMailer từ thư mục src
require "src/PHPMailer.php";
require "src/SMTP.php";
require "src/Exception.php";

if (isset($_POST['email'])) {
    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = 2; // Bật nếu muốn debug chi tiết kết nối
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // Cấu hình tài khoản người gửi của bạn
        $nguoigui = 'phuongntk.25ite@vku.udn.vn'; 
        $matkhau = 'ykzgbevidfornirr';             // Mật khẩu ứng dụng 16 ký tự
        $tennguoigui = 'Phương';

        $mail->Username = $nguoigui;
        $mail->Password = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom($nguoigui, $tennguoigui);

        // Lấy thông tin từ Form (index.php) gửi sang
        $to = $_POST['email'];
        $to_name = "Bạn";
        $tieude = $_POST['tieude'];

        $mail->addAddress($to, $to_name);

        $mail->isHTML(true);
        $mail->Subject = $tieude;

        // Định dạng nội dung email dạng thẻ Bootstrap Card đúng bài Lab
        $noidungthu = '
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Xin chào! ' . htmlspecialchars($to_name) . '</b></h5>
                <h6 class="card-subtitle mb-2 text-muted">Thư gửi từ hệ thống</h6>
                <p class="card-text">' . nl2br(htmlspecialchars($_POST['content'])) . '</p>
            </div>
        </div>';

        $mail->Body = $noidungthu;

        // Xử lý file đính kèm từ form tải lên
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        // Bỏ qua kiểm tra chứng chỉ SSL khi kết nối từ Localhost
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        if ($mail->send()) {
            // Gửi thành công thì chuyển hướng về lại trang index.php
            header("Location: index.php");
            exit();
        }

    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}
?>