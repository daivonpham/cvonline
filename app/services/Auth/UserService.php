<?php

namespace App\Services\Auth;
use App\Models\Auth\UserModel;
use Rakit\Validation\Validator;
use App\services\JwtService;

class UserService
{

    private $userModel;
    private $jwtService;


    public function __construct()
    {

        $this->userModel = new UserModel();
        $this->jwtService = new JwtService();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register($userData)
    {
        $validator = new Validator();
        $validation = $validator->make($userData, [
            'username' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $validation->setMessages([
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
            'same' => ':attribute phải khớp với :other',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }
        $hashedPassword = password_hash($userData['password'], PASSWORD_BCRYPT);
        $this->userModel->register($userData['username'], $userData['email'], $hashedPassword);
        return ['success' => true, 'message' => "Đăng ký thành công!"];
    }

    public function login($userData)
    {
        $validator = new Validator();
        $validation = $validator->make($userData, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $validation->setMessages([
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
            'same' => ':attribute phải khớp với :other',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }

        $user = $this->userModel->findByEmail($userData['email']);
        if (!$user) {
            return ['success' => false, 'errors' => ['email' => ['Email không tồn tại']]];
        }

        if (!password_verify($userData['password'], $user['password'])) {
            return ['success' => false, 'errors' => ['password' => ['Mật khẩu không đúng']]];
        }
        $token = $this->jwtService->generateToken($user);
        $userId = $this->jwtService->getUserIdFromToken($token);
        $_SESSION['user'] = $this->userModel->findById($userId);
        return ['success' => true, 'token' => $token];
    }


    public function updateProfile($userData)
    {
        $validator = new Validator();
        $userId = $this->jwtService->getUserId();

        $validation = $validator->make($userData, [
            'name' => 'required|min:3',
            'nickname' => 'nullable|min:2',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone' => ['required', 'regex:/^(\+84|0)[1-9][0-9]{8}$/'],
            'address' => 'required|min:5',
            'major' => 'required|min:3',
            'website' => 'nullable|url',
            'avatar' => 'uploaded_file:0,2M,png,jpeg,jpg',
        ]);

        $validation->setMessages([
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'date' => ':attribute phải là ngày hợp lệ',
            'in' => ':attribute phải là "male", "female" hoặc "other"',
            'regex' => ':attribute không đúng định dạng số điện thoại',
            'url' => ':attribute phải là URL hợp lệ',
            'uploaded_file' => ':attribute phải là file hình ảnh (png, jpeg) và dung lượng dưới 2MB',

        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }
        $currentProfile = $this->userModel->findById($userId);
        $avatar = $currentProfile['avatar'];

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar'];
            $filename = time() . '_' . $avatar['name'];
            $uploadPath = __DIR__ . '/../../../public/images/avatar/' . $filename;

            if (!is_dir(dirname($uploadPath))) {
                mkdir(dirname($uploadPath), 0777, true);
            }

            if (move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
                $avatar = $filename;
            } else {
                return ["success" => false, "errors" => "Không thể upload avatar"];
            }
        }
        $result = $this->userModel->updateProfile(
            $userId,
            $userData['name'],
            $userData['nickname'],
            $userData['birthday'],
            $userData['gender'],
            $userData['phone'],
            $userData['address'],
            $userData['major'],
            $userData['website'],
            $avatar
        );

        $socialPlatforms = [
            'zalo_link' => 'Zalo',
            'facebook_link' => 'Facebook',
            'instagram_link' => 'Instagram',
            'twitter_link' => 'Twitter',
            'github_link' => 'Github',
            'slack_link' => 'Slack',
            'discord_link' => 'Discord',
            'telegram_link' => 'Telegram',
            'tiktok_link' => 'Tiktok',
            'youtube_link' => 'Youtube'
        ];

        $existingSocialLinks = $this->userModel->getSocialLinks($userId);
        $existingPlatforms = [];
        foreach ($existingSocialLinks as $link) {
            $existingPlatforms[$link['platform']] = $link['link_id'];
        }
        foreach ($socialPlatforms as $inputName => $platform) {
            $linkValue = $userData[$inputName] ?? '';

            if (trim($linkValue) === '') {
                if (isset($existingPlatforms[$platform])) {

                    $this->userModel->deleteSocialLink($existingPlatforms[$platform]);
                    unset($existingPlatforms[$platform]); 
                }
            } elseif (trim($linkValue) !== '') {
                if (isset($existingPlatforms[$platform])) {
                    $this->userModel->updateSocialLink(
                        $existingPlatforms[$platform],
                        $platform,
                        $linkValue
                    );
                } else {
                    $this->userModel->addSocialLink(
                        $userId,
                        $platform,
                        $linkValue
                    );
                }

                if ($result) {
                    return ["success" => true, "message" => "Lưu thông tin thành công!"];
                } else {
                    return ["success" => false, "errors" => "Lưu thông tin thất bại!"];
                }
            }
        }
    }

    public function getUserProfile($userId)
    {
        $userProfile = $this->userModel->findById($userId);
        $socialLinks = $this->userModel->getSocialLinks($userId);

        $formattedSocialLinks = [];
        foreach ($socialLinks as $link) {
            $formattedSocialLinks[strtolower($link['platform']) . '_link'] = $link['url'];
        }

        return [
            'profile' => $userProfile,
            'socialLinks' => $formattedSocialLinks
        ];
    }
}