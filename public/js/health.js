// =================== Cập nhật chỉ số ngẫu nhiên ===================
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function updateHealthMetrics() {
  document.getElementById('heart-rate').textContent = getRandomInt(60, 100) + ' bpm';
  document.getElementById('steps').textContent = getRandomInt(3000, 12000) + ' bước';
  document.getElementById('sleep-hours').textContent = getRandomInt(5, 9) + ' giờ';
}
setInterval(updateHealthMetrics, 3000);
updateHealthMetrics();


// =================== Tính toán BMI + Gợi ý ===================
document.getElementById('bodyMetricsForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const height = parseFloat(document.getElementById('height').value) / 100;
  const weight = parseFloat(document.getElementById('weight').value);
  const goal = document.getElementById('goal').value;
  const bmiResult = document.getElementById('bmi-result');
  const recommendation = document.getElementById('recommendation-content');
  const exerciseButton = document.getElementById('exercise-button');

  if (height <= 0 || weight <= 0) {
    bmiResult.textContent = "⚠️ Vui lòng nhập giá trị hợp lệ.";
    recommendation.innerHTML = "";
    exerciseButton.style.display = "none";
    return;
  }

  const bmi = (weight / (height * height)).toFixed(1);
  let status = "";
  if (bmi < 18.5) status = "Thiếu cân 🦴";
  else if (bmi < 23) status = "Bình thường 💪";
  else if (bmi < 25) status = "Thừa cân ⚖️";
  else status = "Béo phì 🍔";

  bmiResult.innerHTML = `BMI của bạn là <strong>${bmi}</strong> — ${status}`;

  // Gợi ý theo mục tiêu
  let tips = "";
  if (goal === "weight_loss") {
    tips = `
      <h3>🎯 Mục tiêu: Giảm cân</h3>
      <ul>
        <li>Tập cardio 30 phút/ngày: chạy, đạp xe, bơi.</li>
        <li>Giảm tinh bột nhanh, tăng rau và protein.</li>
        <li>Ngủ đủ 7–8 tiếng để hỗ trợ trao đổi chất.</li>
      </ul>`;
  } else if (goal === "muscle_gain") {
    tips = `
      <h3>🎯 Mục tiêu: Tăng cơ</h3>
      <ul>
        <li>Tập tạ 4–5 buổi/tuần, chú trọng bài compound.</li>
        <li>Ăn đủ protein (1.8–2g/kg cân nặng).</li>
        <li>Thêm tinh bột tốt như khoai lang, yến mạch.</li>
      </ul>`;
  } else if (goal === "fat_loss") {
    tips = `
      <h3>🎯 Mục tiêu: Giảm béo</h3>
      <ul>
        <li>Kết hợp HIIT & ăn kiêng ít dầu mỡ, ít đường.</li>
        <li>Uống đủ nước, tránh ăn khuya.</li>
        <li>Tập plank và cardio để đốt mỡ nhanh.</li>
      </ul>`;
  }

  // Gợi ý thêm theo tình trạng BMI
  let extraTip = "";
  if (status.includes("Thiếu cân")) {
    extraTip = "<p>👉 Nên ăn thêm calo và tập tăng cơ nhẹ để cải thiện cân nặng.</p>";
  } else if (status.includes("Béo phì")) {
    extraTip = "<p>⚠️ Nên giảm lượng calo và tăng vận động mỗi ngày.</p>";
  }

  // Hiển thị nội dung gợi ý
  recommendation.innerHTML = tips + extraTip;

  // Hiện nút "Xem Bài Tập"
  exerciseButton.style.display = "block";
});
  // ===== Menu Toggle =====
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu");
  if (toggle) {
    toggle.addEventListener("click", () => {
      menu.classList.toggle("show");
    });
  }

