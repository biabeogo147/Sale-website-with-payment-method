<?php
use yii\helpers\Html;

// Đường dẫn đến thư mục chứa các tệp .json
$dir = Yii::getAlias('@backend/web/storage/order/');

// Lấy danh sách tất cả các tệp .json trong thư mục
$jsonFiles = glob($dir . '*.json');
?>

<h2 style="text-align:center;">Dach sách các đơn hàng</h2>

<?php
// Đường dẫn đến thư mục chứa các tệp .json
$dir = Yii::getAlias('@backend/web/storage/order/');

// Lấy danh sách tất cả các tệp .json trong thư mục
$jsonFiles = glob($dir . '*.json');

// Bắt đầu lưới
echo "<div style='display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;'>";

// Lặp qua danh sách và hiển thị tên của mỗi tệp
foreach ($jsonFiles as $file) {
    // Lấy tên tệp từ đường dẫn đầy đủ
    $filename = basename($file);

    // Tạo đường dẫn tuyệt đối đến tệp
    $filePath = "/storage/order/" . $filename;

    // Đọc và phân tích nội dung của tệp .json
    $content = file_get_contents($file);
    $json = json_decode($content, true);

    // Kiểm tra mã
    if (isset($json['code']) && $json['code'] == '000') {
        $status = 'Đã thanh toán';
    } else {
        $status = 'Chưa thanh toán';
    }

    // Hiển thị tên tệp dưới dạng liên kết trong một ô của lưới
    echo "<div style='border: 1px solid #ccc; padding: 10px; border-radius: 10px;'><a href=\"$filePath\">$filename</a><br>Status: $status</div>";
}

// Kết thúc lưới
echo "</div>";
?>