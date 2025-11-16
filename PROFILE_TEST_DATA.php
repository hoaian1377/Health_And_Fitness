<!-- Profile Blade Template - Ví dụ dữ liệu để test -->

<!-- 
    Để test profile với dữ liệu giả, bạn có thể:
    
    1. Cách 1: Cập nhật User model seed
    2. Cách 2: Sử dụng Tinker
    3. Cách 3: Form UI trực tiếp
-->

<!-- CÁCH 1: Cập nhật DatabaseSeeder -->
<!-- Thêm vào database/seeders/DatabaseSeeder.php: -->

<?php
/*
use App\Models\User;

public function run(): void
{
    User::create([
        'name' => 'Vũ Quốc Anh',
        'email' => '0882500202574@example.com',
        'password' => bcrypt('password'),
        'phone' => '0882500202',
        'dob' => '2005-02-24',
        'gender' => 'male',
        'address' => 'TP. Hồ Chí Minh',
        'height' => 175.5,
        'weight' => 70.0,
        'bmi' => 22.8,
        'blood_type' => 'O+',
        'activity_level' => 'moderate',
        'subscription_plan' => 'premium',
    ]);
}
*/
?>

<!-- CÁCH 2: Sử dụng Tinker (PHP Interactive Shell) -->
<!-- 
    Chạy trong terminal:
    php artisan tinker
    
    Sau đó paste các lệnh:
    
    $user = Auth::user();
    $user->update([
        'phone' => '0882500202',
        'dob' => '2005-02-24',
        'gender' => 'male',
        'address' => 'TP. Hồ Chí Minh',
        'height' => 175.5,
        'weight' => 70.0,
        'blood_type' => 'O+',
        'activity_level' => 'moderate',
        'subscription_plan' => 'premium',
    ]);
    
    exit;
-->

<!-- CÁCH 3: Dữ liệu tĩnh để đọc từ view -->
<?php
$sampleData = [
    'personal' => [
        'fullName' => 'Vũ Quốc Anh',
        'email' => '0882500202574@gmail.com',
        'phone' => '088 2500 2574',
        'dob' => '2005-02-24',
        'gender' => 'male',
        'address' => 'TP. Hồ Chí Minh, Việt Nam'
    ],
    'health' => [
        'height' => 175.5,
        'weight' => 70.0,
        'bmi' => 22.8,
        'blood_type' => 'O+',
        'activity_level' => 'moderate'
    ],
    'goals' => [
        [
            'name' => 'Tập luyện',
            'icon' => 'dumbbell',
            'description' => 'Tập luyện 5 ngày/tuần',
            'progress' => 60,
            'current' => 3,
            'total' => 5,
            'unit' => 'ngày'
        ],
        [
            'name' => 'Giảm cân',
            'icon' => 'scale-balanced',
            'description' => 'Giảm 5 kg trong 3 tháng',
            'progress' => 40,
            'current' => 2,
            'total' => 5,
            'unit' => 'kg'
        ],
        [
            'name' => 'Uống nước',
            'icon' => 'water',
            'description' => 'Uống 2 lít nước mỗi ngày',
            'progress' => 75,
            'current' => 1.5,
            'total' => 2,
            'unit' => 'L'
        ]
    ],
    'stats' => [
        'notes' => 0,
        'support' => '-'
    ]
];
?>

<!-- TEST DATA STRUCTURE -->

<!-- 1. Test Personal Form -->
<form id="test-personal">
    <input name="fullName" value="Vũ Quốc Anh">
    <input name="phone" value="0882500202">
    <input name="dob" value="2005-02-24">
    <select name="gender">
        <option value="male" selected>Nam</option>
    </select>
    <input name="address" value="TP. Hồ Chí Minh">
</form>

<!-- 2. Test Health Form -->
<form id="test-health">
    <input name="height" value="175.5" type="number">
    <input name="weight" value="70" type="number" step="0.1">
    <select name="blood_type">
        <option value="O+" selected>O+</option>
    </select>
    <select name="activity_level">
        <option value="moderate" selected>Vừa phải</option>
    </select>
</form>

<!-- 3. Test Goals Data -->
<div id="test-goals">
    <!-- Goal 1 -->
    <div class="goal-card">
        <div class="goal-icon">
            <i class="fa-solid fa-dumbbell"></i>
        </div>
        <div class="goal-content">
            <h4>Tập luyện</h4>
            <p>Tập luyện 5 ngày/tuần</p>
            <div class="goal-progress">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 60%"></div>
                </div>
                <span class="progress-text">3/5 ngày</span>
            </div>
        </div>
    </div>

    <!-- Goal 2 -->
    <div class="goal-card">
        <div class="goal-icon">
            <i class="fa-solid fa-scale-balanced"></i>
        </div>
        <div class="goal-content">
            <h4>Giảm cân</h4>
            <p>Giảm 5 kg trong 3 tháng</p>
            <div class="goal-progress">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 40%"></div>
                </div>
                <span class="progress-text">2/5 kg</span>
            </div>
        </div>
    </div>

    <!-- Goal 3 -->
    <div class="goal-card">
        <div class="goal-icon">
            <i class="fa-solid fa-water"></i>
        </div>
        <div class="goal-content">
            <h4>Uống nước</h4>
            <p>Uống 2 lít nước mỗi ngày</p>
            <div class="goal-progress">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 75%"></div>
                </div>
                <span class="progress-text">1.5/2 L</span>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript: Copy dữ liệu test vào form -->
<script>
function populateTestData() {
    const testData = {
        fullName: 'Vũ Quốc Anh',
        phone: '0882500202',
        dob: '2005-02-24',
        gender: 'male',
        address: 'TP. Hồ Chí Minh',
        height: 175.5,
        weight: 70,
        blood_type: 'O+',
        activity_level: 'moderate'
    };

    // Fill personal form
    document.getElementById('fullName').value = testData.fullName;
    document.getElementById('phone').value = testData.phone;
    document.getElementById('dob').value = testData.dob;
    document.getElementById('gender').value = testData.gender;
    document.getElementById('address').value = testData.address;

    // Fill health form
    document.getElementById('height').value = testData.height;
    document.getElementById('weight').value = testData.weight;
    document.getElementById('blood_type').value = testData.blood_type;
    document.getElementById('activity_level').value = testData.activity_level;

    console.log('✅ Test data populated');
}

// Chạy: populateTestData()
</script>

<!-- NOTES UNTUK DEVELOPER -->
<!--
    📝 Catatan Penting:

    1. DEVELOPMENT MODE:
       - Muat halaman profile
       - Buka DevTools (F12)
       - Jalankan: populateTestData()
       - Form akan terisi dengan data test

    2. PRODUCTION READY:
       - Migration: php artisan migrate
       - Storage link: php artisan storage:link
       - Clear cache: php artisan cache:clear

    3. API TESTING:
       - Gunakan Postman atau Insomnia
       - Endpoint: POST /api/profile/update
       - Header: Content-Type: application/json
       - Header: X-CSRF-TOKEN: <dari meta tag>
       - Body: {
           "type": "personal",
           "data": {
             "fullName": "Vũ Quốc Anh",
             ...
           }
         }

    4. FILE UPLOAD TEST:
       - Gunakan form data, bukan JSON
       - Field: avatar (file)
       - Endpoint: POST /api/profile/avatar

    5. DATABASE:
       - Migration file: database/migrations/2024_11_16_000000_add_profile_fields_to_users_table.php
       - Run: php artisan migrate
       - Rollback: php artisan migrate:rollback

    6. TROUBLESHOOTING:
       - Check storage/logs/laravel.log
       - Check browser DevTools console (F12)
       - Check network tab untuk melihat requests
       - Pastikan file upload storage sudah di-link
-->
