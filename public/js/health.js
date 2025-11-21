document.addEventListener("DOMContentLoaded", () => {
  const bmiForm = document.getElementById("bmiForm");
  const resultBox = document.getElementById("bmiResult");
  const journeySection = document.getElementById("journeySection");
  const bmiValue = document.getElementById("bmiValue");
  const bmiStatus = document.getElementById("bmiStatus");

  bmiForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const height = parseFloat(document.getElementById("height").value) / 100;
    const weight = parseFloat(document.getElementById("weight").value);
    const gender = document.getElementById("gender").value;

    if (!height || !weight || height <= 0 || weight <= 0) {
      alert("⚠️ Vui lòng nhập giá trị hợp lệ!");
      return;
    }

    const bmi = (weight / (height * height)).toFixed(1);
    bmiValue.textContent = bmi;

    let status = "";
    if (bmi < 18.5) {
      status = "💡 Bạn đang gầy. Hãy chọn mục tiêu *Tăng cân* hoặc *Tăng cơ* nhé!";
    } else if (bmi < 24.9) {
      status = "✅ Cơ thể bạn đang ở mức lý tưởng! Có thể *Tăng cơ* để khỏe mạnh hơn.";
    } else if (bmi < 29.9) {
      status = "⚠️ Bạn đang thừa cân nhẹ. Hãy chọn mục tiêu *Giảm cân* để cải thiện vóc dáng.";
    } else {
      status = "🚨 Bạn đang béo phì. Khuyên bạn nên *Giảm cân kết hợp tập luyện thường xuyên*!";
    }

    bmiStatus.textContent = status;
    resultBox.classList.remove("hidden");

    // Hiện phần hành trình sau khi tính xong
    journeySection.classList.remove("hidden");
    journeySection.scrollIntoView({ behavior: "smooth" });
  });

  // Chuyển hướng khi chọn mục tiêu
  document.querySelectorAll(".goal-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const goal = btn.dataset.goal;
      window.location.href = `/fitness?goal=${goal}`;
    });
  });
});
// ===== Menu Toggle =====
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu");
  if (toggle) {
    toggle.addEventListener("click", () => {
      menu.classList.toggle("show");
    });
  }
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.goal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const goal = this.dataset.goal;

            if (goal === "gain") {
                window.location.href = goalRoutes.nutrition;
            }
            else if (goal === "muscle") {
                window.location.href = goalRoutes.workouts;
            }
            else if (goal === "lose") {
                window.location.href = goalRoutes.community;
            }
        });
    });
});