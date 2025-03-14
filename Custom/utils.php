<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return dirname(__DIR__) . '/' . $path; // Chuyển từ __DIR__ sang dirname(__DIR__) để xử lý thư mục bên ngoài `custom`
}

/**
 * Load a view
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function render($name, $data = [], $route = null)
{
    // Nếu có $route, gửi header để thay đổi URL
    if ($route !== null) {
        header("Location: {$route}");
    }

    $viewPath = basePath("app/views/{$name}.php");
    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View not found: {$name}";
    }
}

/**
 * Load an admin view
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function loadAdmin($name, $data = [])
{
    $viewPath = basePath("App/views/admin/{$name}.view.php");
    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "Admin view not found: {$name}";
    }
}

/**
 * Save data to session
 *
 * @param string $key
 * @param mixed $value
 * @return void
 */
function with($key, $value)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION[$key] = $value;
}

/**
 * Load a partial view
 *
 * @param string $name
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial not found: {$name}";
    }
}

/**
 * Inspect a value
 *
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/**
 * Inspect a value and terminate execution
 *
 * @param mixed $value
 * @return void
 */
function check($data, $level = 0)
{
    // Danh sách màu cho từng cấp
    $colors = [
        0 => '#1f2937', // Cấp 0: Xám đậm
        1 => '#7c3aed', // Cấp 1: Tím
        2 => '#16a34a', // Cấp 2: Xanh lá
        3 => '#d97706', // Cấp 3: Cam
        4 => '#be123c', // Cấp 4: Đỏ hồng
    ];

    // Lấy màu theo cấp, nếu vượt quá thì dùng màu cuối
    $color = isset($colors[$level]) ? $colors[$level] : end($colors);

    // Khoảng cách thụt lề (20px mỗi cấp)
    $indent = $level * 20;

    // Bắt đầu container chính
    echo '<div style="
        background: #f9fafb;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-family: Consolas, monospace;
        font-size: 14px;
        line-height: 1.5;
        color: ' . $color . ';
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: 10px 0;
        overflow-x: auto;
        margin-left: ' . $indent . 'px;
    ">';

    if (is_array($data) || is_object($data)) {
        echo '<ul style="list-style: none; padding: 0;">';
        foreach ((array) $data as $key => $value) {
            echo '<li style="margin: 5px 0;">';
            // Kiểm tra $key trước khi dùng htmlspecialchars
            $key_display = ($key === null) ? 'NULL' : htmlspecialchars((string) $key);
            echo '<span style="color: #1e40af; font-weight: bold;">' . $key_display . '</span>: ';

            if (is_array($value) || is_object($value)) {
                // Đệ quy cho cấp tiếp theo
                check($value, $level + 1);
            } else {
                // Kiểm tra $value trước khi dùng htmlspecialchars
                $value_display = ($value === null) ? 'NULL' : htmlspecialchars((string) $value);
                echo '<span style="color: ' . $color . ';">' . $value_display . '</span>';
            }
            echo '</li>';
        }
        echo '</ul>';
    } else {
        // Kiểm tra $data trước khi dùng htmlspecialchars
        $data_display = ($data === null) ? 'NULL' : htmlspecialchars((string) $data);
        echo '<span style="color: ' . $color . ';">' . $data_display . '</span>';
    }

    echo '</div>';
}

/**
 * Format salary
 *
 * @param string $salary
 * @return string
 */
function formatSalary($salary)
{
    $salary = is_numeric($salary) ? (float) $salary : 0;
    return number_format($salary, 0, ',', '.') . ' VNĐ';
}

/**
 * Sanitize data
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given URL
 *
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}

/**
 * Generate a random code
 *
 * @return string
 */
function generateCode()
{
    $randomNumber = rand(1000, 9999);
    return 'OD' . $randomNumber;
}

/**
 * Execute a POST request using cURL
 *
 * @param string $url
 * @param string $data
 * @return string
 */
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 * Generate a random password
 *
 * @param int $length
 * @return string
 */
function generatePassword($length = 12)
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $specialChars = '@$!%*?&';
    $allChars = $uppercase . $lowercase . $numbers . $specialChars;

    $password = $uppercase[random_int(0, strlen($uppercase) - 1)] .
        $lowercase[random_int(0, strlen($lowercase) - 1)] .
        $numbers[random_int(0, strlen($numbers) - 1)] .
        $specialChars[random_int(0, strlen($specialChars) - 1)];

    for ($i = 4; $i < $length; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }

    return str_shuffle($password);
}

 function calculateTimeAgo($dateTime)
    {
        if (empty($dateTime)) {
            return 'Không xác định';
        }

        $updateDate = new DateTime($dateTime);
        $now = new DateTime();
        $interval = $now->diff($updateDate);

        // Lấy các đơn vị thời gian từ interval
        $days = $interval->days; // Số ngày
        $hours = $interval->h + ($interval->days * 24); // Tính tổng số giờ (bao gồm cả ngày)
        $minutes = $interval->i; // Số phút
        $seconds = $interval->s; // Số giây

        // Hiển thị theo đơn vị phù hợp
        if ($days > 30) {
            $months = floor($days / 30); // Tính số tháng (làm tròn xuống)
            return "Cập nhật $months tháng trước";
        } elseif ($days > 0) {
            return "Cập nhật $days ngày trước";
        } elseif ($hours > 0) {
            return "Cập nhật $hours giờ trước";
        } elseif ($minutes > 0) {
            return "Cập nhật $minutes phút trước";
        } elseif ($seconds > 0) {
            return "Cập nhật $seconds giây trước";
        } else {
            return "Vừa cập nhật";
        }
    }

function formatDateToVietnamese($date)
{
    if (empty($date) || $date === 'Present' || $date === 'present' || $date === null) {
        return 'Hiện tại';
    }

    try {
        $dateObj = new DateTime($date);
        $day = $dateObj->format('d');
        $month = $dateObj->format('m');
        $year = $dateObj->format('Y');
        return "$day-$month-$year";
    } catch (Exception $e) {
        error_log("Lỗi định dạng ngày: " . $e->getMessage());
        return $date; 
    }
}

function formatDescription($text)
{
    $text = strip_tags($text);
    $text = str_replace(array("\r\n", "\r", "\n"), "\n", $text); 

    $lines = explode("\n", trim($text));
    $output = '<ul class="mt-2 space-y-2 text-gray-600">';
    $currentMain = '';

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line))
            continue;
        if (strpos($line, '-') === 0) {
            $subItem = trim(substr($line, 1));
            if (!empty($subItem)) {
                $output .= '<li class="ml-4 flex items-center gap-2"><span class="text-blue-600">•</span>' .
                    htmlspecialchars($subItem) . '</li>';
            }
        } else {
            if ($currentMain !== '') {
                $output .= '</ul></li>';
            }
            $currentMain = htmlspecialchars($line);
            if (!empty($currentMain)) {
                $output .= '<li class="  items-center gap-2"><span class="text-blue-600 mr-3"><i class="fas fa-check-circle text-blue-600 mt-1"></i></span>' .
                    $currentMain . '<ul class="mt-1 space-y-1">';
            }
        }
    }

    if ($currentMain !== '') {
        $output .= '</ul></li>';
    }
    $output .= '</ul>';

    return $output;
}


function formatDescriptionTem1($text)
{
    $text = strip_tags($text);
    $text = str_replace(array("\r\n", "\r", "\n"), "\n", $text);

    $lines = explode("\n", trim($text));
    $output = '<ul class="mt-2 space-y-2 text-gray-600">';
    $currentMain = '';

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line))
            continue;
        if (strpos($line, '-') === 0) {
            $subItem = trim(substr($line, 1));
            if (!empty($subItem)) {
                $output .= '<li class="ml-4 flex items-center gap-2"><span >•</span>' .
                    htmlspecialchars($subItem) . '</li>';
            }
        } else {
            if ($currentMain !== '') {
                $output .= '</ul></li>';
            }
            $currentMain = htmlspecialchars($line);
            if (!empty($currentMain)) {
                $output .= '<li class="  items-center gap-2"><span class=" mr-3">&#10148</span>' .
                    $currentMain . '<ul class="mt-1 space-y-1">';
            }
        }
    }

    if ($currentMain !== '') {
        $output .= '</ul></li>';
    }
    $output .= '</ul>';

    return $output;
}


function formatData($data)
{
    $array = explode(',', $data); // Chuyển chuỗi thành mảng bằng dấu ,
    return implode("\n", $array); // Ghép lại với dấu xuống dòng
}

function formatLangtech($data)
{
    $result = '';
    if ($data !== null && is_string($data)) {
        $array = explode(',', $data);

        foreach ($array as $item) {
            $item = trim($item);
            if (!empty($item)) { 
                $result .= '<span class="px-3 py-1 bg-gray-100 text-black rounded-full text-sm">'
                    . htmlspecialchars($item)
                    . '</span>' . "\n";
            }
        }
    }

    return $result;
}