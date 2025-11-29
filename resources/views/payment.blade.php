<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Payment Modal Styles */
.payment-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(4px);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  overscroll-behavior: contain;
}

.payment-overlay.show {
  display: flex;
}

.payment-modal {
  width: 95%;
  max-width: 900px;
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
  overflow: hidden;
  transform: translateY(10px);
  animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  display: flex;
  flex-direction: column;
  max-height: 90vh;
}

@keyframes modalIn {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.96);
  }

  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.payment-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 32px;
  background: #fff;
  border-bottom: 1px solid #f0f0f0;
}

.payment-header h3 {
  margin: 0;
  font-size: 20px;
  font-weight: 800;
  color: #111;
}

.payment-close {
  background: #f5f5f5;
  border: none;
  color: #111;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s;
}

.payment-close:hover {
  background: #e0e0e0;
  transform: rotate(90deg);
}

.payment-body {
  overflow-y: auto;
  padding: 0;
  display: block;
}

.payment-content {
  padding: 32px;
}

/* Stepper */
.stepper {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  margin-bottom: 40px;
}

.step {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #999;
  font-weight: 600;
  font-size: 14px;
  transition: color 0.3s;
}

.step .dot {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: #f0f0f0;
  color: #999;
  font-size: 14px;
  font-weight: 700;
  transition: all 0.3s;
}

.step.active {
  color: #111;
}

.step.active .dot {
  background: #111;
  color: #ffea00;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.step.done .dot {
  background: #18c96e;
  color: #fff;
}

.step-divider {
  height: 2px;
  width: 40px;
  background: #f0f0f0;
  border-radius: 2px;
}

/* Goal Tabs */
.goal-tabs {
  display: flex;
  gap: 12px;
  margin-bottom: 32px;
  overflow-x: auto;
  padding-bottom: 8px;
  scrollbar-width: none;
}

.goal-tabs::-webkit-scrollbar {
  display: none;
}

.goal-tab {
  padding: 10px 20px;
  border-radius: 100px;
  background: #f5f5f5;
  border: 1px solid transparent;
  color: #666;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.2s;
}

.goal-tab:hover {
  background: #eee;
  color: #111;
}

.goal-tab.active {
  background: #111;
  color: #fff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Plans */
.plans-group {
  display: none;
  animation: fadeIn 0.3s ease;
}

.plans-group.active {
  display: block;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.plans {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
}

.plan-card {
  border: 2px solid #f0f0f0;
  border-radius: 20px;
  padding: 24px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  background: #fff;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.plan-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
  border-color: #e0e0e0;
}

.plan-card.active {
  border-color: #111;
  background: #fff;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
}

.plan-card.active::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: #ffea00;
}

.plan-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 16px;
}

.plan-title {
  font-weight: 800;
  font-size: 20px;
  color: #111;
  margin: 0;
}

.badge-popular {
  background: linear-gradient(135deg, #ffea00, #ffd000);
  color: #111;
  font-size: 11px;
  font-weight: 800;
  padding: 4px 10px;
  border-radius: 100px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.plan-price {
  font-size: 32px;
  font-weight: 800;
  color: #111;
  letter-spacing: -1px;
}

.plan-price span {
  font-size: 14px;
  color: #888;
  font-weight: 500;
  letter-spacing: 0;
}

.plan-divider {
  height: 1px;
  background: #f0f0f0;
  margin: 20px 0;
}

.plan-features {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
  flex-grow: 1;
}

.plan-features li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  margin-bottom: 12px;
  font-size: 14px;
  color: #555;
  line-height: 1.5;
}

.plan-features li i {
  color: #18c96e;
  margin-top: 3px;
  flex-shrink: 0;
}

.btn-select-plan {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 2px solid #111;
  background: transparent;
  color: #111;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.2s;
}

.plan-card:hover .btn-select-plan {
  background: #111;
  color: #fff;
}

.plan-card.active .btn-select-plan {
  background: #111;
  color: #ffea00;
  border-color: #111;
}

/* Payment methods */
.methods {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin: 24px 0 32px;
}

.method-btn {
  border: 2px solid #f0f0f0;
  border-radius: 16px;
  padding: 20px;
  background: #fff;
  cursor: pointer;
  font-weight: 700;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  transition: all 0.2s;
  color: #666;
}

.method-btn i {
  font-size: 24px;
  color: #111;
}

.method-btn:hover {
  border-color: #ddd;
  background: #f9f9f9;
}

.method-btn.active {
  border-color: #111;
  background: #fff;
  color: #111;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

/* Inputs */
.field {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-bottom: 20px;
}

.field label {
  font-weight: 700;
  font-size: 13px;
  color: #444;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.input,
.select {
  padding: 14px 16px;
  border: 2px solid #eee;
  border-radius: 12px;
  outline: none;
  font-size: 15px;
  font-weight: 500;
  transition: all 0.2s;
  background: #fcfcfc;
}

.input:focus,
.select:focus {
  border-color: #111;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
}

/* Footer actions */
.payment-actions {
  display: flex;
  justify-content: flex-end;
  gap: 16px;
  margin-top: 40px;
  padding-top: 24px;
  border-top: 1px solid #f0f0f0;
}

.btn {
  padding: 14px 28px;
  border-radius: 12px;
  font-size: 15px;
  letter-spacing: 0.3px;
}

.btn-secondary {
  background: transparent;
  color: #666;
  border: 1px solid transparent;
}

.btn-secondary:hover {
  color: #111;
  background: #f5f5f5;
}

.btn-primary {
  background: #111;
  color: #fff;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  transition: all 0.2s;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
  color: #ffea00;
}

/* Responsive */
@media (max-width: 640px) {
  .payment-modal {
    width: 100%;
    height: 100%;
    max-height: 100%;
    border-radius: 0;
  }
  
  .payment-header {
    padding: 16px 20px;
  }
  
  .payment-content {
    padding: 20px;
  }
  
  .stepper {
    gap: 8px;
    margin-bottom: 24px;
  }
  
  .step-divider {
    width: 20px;
  }
  
  .plans {
    grid-template-columns: 1fr;
  }
  
  .payment-actions {
    flex-direction: column-reverse;
    gap: 12px;
  }
  
  .btn {
    width: 100%;
  }
}
    </style>
</head>
<body>
    <!-- Payment Modal -->
<div class="payment-overlay" id="paymentOverlay" aria-hidden="true">
    <div class="payment-modal" role="dialog" aria-modal="true" aria-labelledby="paymentTitle">

        <!-- Header -->
        <div class="payment-header">
            <h3 id="paymentTitle">Thanh toán dịch vụ</h3>
            <button class="payment-close" id="closePaymentBtn" aria-label="Đóng">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="payment-body single">
            <div class="payment-content">

                <!-- Stepper -->
                <div class="stepper" id="paymentStepper">
                    <div class="step active" data-step="1">
                        <span class="dot">1</span> Chọn gói
                    </div>
                    <div class="step-divider"></div>

                    <div class="step" data-step="2">
                        <span class="dot">2</span> Xác nhận
                    </div>
                </div>

                <!-- Step 1: Plans -->
                <section class="step-panel" data-panel="1">
                    <!-- Goal Tabs -->
                    <div class="goal-tabs" id="goalTabs">
                        @foreach($fitnessGoals as $goal)
                        <button class="goal-tab {{ $loop->first ? 'active' : '' }}" data-goal="{{ $goal->fitness_goalID }}">
                            {{ $goal->goal_name }}
                        </button>
                        @endforeach
                    </div>

                    <!-- Plans Container -->
                    <div class="plans-container">
                        @foreach($fitnessGoals as $goal)
                        <div class="plans-group {{ $loop->first ? 'active' : '' }}" data-goal-group="{{ $goal->fitness_goalID }}">
                            <div class="plans">
                                @foreach($goal->packages as $package)
                                <div class="plan-card" 
                                     data-plan="{{ $package->name_package }}" 
                                     data-price="{{ $package->price }}">
                                    <div class="plan-header">
                                        <div class="plan-title">{{ $package->name_package }}</div>
                                        @if($package->price > 500000)
                                            <span class="badge-popular">Phổ biến</span>
                                        @endif
                                    </div>
                                    <div class="plan-price">
                                        {{ number_format($package->price, 0, ',', '.') }}đ 
                                        <span>/{{ $package->duration ?? 'tháng' }}</span>
                                    </div>
                                    <div class="plan-divider"></div>
                                    <ul class="plan-features">
                                        @if($package->description)
                                            @foreach(explode("\n", $package->description) as $line)
                                                <li><i class="fa-solid fa-check"></i> {{ $line }}</li>
                                            @endforeach
                                        @else
                                            <li><i class="fa-solid fa-check"></i> Truy cập đầy đủ tính năng</li>
                                        @endif
                                    </ul>
                                    <button class="btn-select-plan">Chọn gói này</button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="payment-actions">
                        <button class="btn btn-secondary" data-action="close">Hủy</button>
                        <button class="btn btn-primary" data-action="next">Tiếp tục</button>
                    </div>
                </section>

                <!-- Step 2: Confirm -->
                <section class="step-panel" data-panel="2" hidden>
                    <div class="confirm-table">
                        <div class="confirm-row"><span>Gói</span><strong id="confirmPlan">Pro</strong></div>
                        <div class="confirm-row"><span>Chu kỳ</span><span>1 tháng</span></div>
                        
                        <!-- Voucher Input -->
                        <div class="confirm-row voucher-row">
                            <span>Mã giảm giá</span>
                            <div class="voucher-input-group">
                                <input type="text" id="voucherCode" placeholder="Nhập mã" class="input-small">
                                <button class="btn-small" id="applyVoucherBtn">Áp dụng</button>
                            </div>
                        </div>
                        <div class="confirm-row" id="discountRow" style="display: none;">
                            <span>Giảm giá</span>
                            <span id="discountValue" class="text-success">-0đ</span>
                        </div>

                        <div class="confirm-row"><span>Tạm tính</span><span id="confirmPrice">599.000đ</span></div>
                        <div class="confirm-row"><span>VAT (10%)</span><span id="confirmVat">19.900đ</span></div>
                        <div class="confirm-row total"><span>Tổng thanh toán</span><strong id="confirmTotal">218.900đ</strong></div>
                    </div>

                    <div class="payment-actions">
                        <button class="btn btn-secondary" data-action="back">Quay lại</button>
                        <button class="btn btn-primary" data-action="pay">Thanh toán</button>
                    </div>
                </section>

                <!-- Step 3: Success -->
                <section class="step-panel" data-panel="3" hidden>
                    <div class="success-state show" id="paySuccess">
                        <div class="success-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="success-title">Thanh toán thành công!</div>
                        <div class="success-desc">Cảm ơn bạn đã tin tưởng HealthFit. Gói của bạn đã được kích hoạt.</div>
                    </div>
                </section>

            </div>

        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Minimal, framework-free interactions for the payment modal
(function () {
  const overlay = document.getElementById('paymentOverlay');
  const openBtn = document.getElementById('openPaymentBtn');
  const closeBtn = document.getElementById('closePaymentBtn');
  if (!overlay || !openBtn || !closeBtn) return;

  const formatCurrency = (v) => v.toLocaleString('vi-VN') + 'đ';

  // State
  let currentStep = 1;
  let selectedPlan = { key: 'pro', price: 199000, label: 'Pro' };

  // Elements
  const planList = document.getElementById('planList');
  const steps = Array.from(document.querySelectorAll('.step'));
  const panels = Array.from(document.querySelectorAll('.step-panel'));
  const confirmPlan = document.getElementById('confirmPlan');
  const confirmTotal = document.getElementById('confirmTotal');
  const confirmPrice = document.getElementById('confirmPrice');
  const confirmVat = document.getElementById('confirmVat');
  const successEl = document.getElementById('paySuccess');
  // Plan badge
  const planBadge = document.getElementById('planBadge');
  const paymentBody = document.querySelector('.payment-body');
  const paymentStepper = document.getElementById('paymentStepper');

  function open() {
    overlay.classList.add('show');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
    goToStep(1);
  }

  function close() {
    overlay.classList.remove('show');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    document.documentElement.style.overflow = '';
  }

  function goToStep(step) {
    currentStep = step;
    steps.forEach((s) => {
      const n = Number(s.dataset.step);
      s.classList.toggle('active', n === step);
      s.classList.toggle('done', n < step);
    });
    panels.forEach((p) => {
      const isTarget = Number(p.dataset.panel) === step;
      p.hidden = !isTarget;
    });

    // Hide stepper on step 3 (Success)
    if (paymentStepper) {
      paymentStepper.style.display = step === 3 ? 'none' : '';
    }
    successEl && successEl.classList.remove('show');
  }

  // Voucher Logic
  const voucherCodeInput = document.getElementById('voucherCode');
  const applyVoucherBtn = document.getElementById('applyVoucherBtn');
  const discountRow = document.getElementById('discountRow');
  const discountValueEl = document.getElementById('discountValue');

  let currentDiscount = { type: null, value: 0 };

  if (applyVoucherBtn) {
    applyVoucherBtn.addEventListener('click', () => {
      const code = voucherCodeInput.value.trim();
      if (!code) return;

      applyVoucherBtn.disabled = true;
      applyVoucherBtn.textContent = 'Đang kiểm tra...';

      fetch('/api/voucher/check', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ code })
      })
        .then(res => res.json())
        .then(data => {
          applyVoucherBtn.disabled = false;
          applyVoucherBtn.textContent = 'Áp dụng';

          if (data.success) {
            currentDiscount = {
              type: data.discount_type,
              value: Number(data.discount_value)
            };
            discountRow.style.display = 'flex';
            alert(data.message);
            updateSummary();
          } else {
            currentDiscount = { type: null, value: 0 };
            discountRow.style.display = 'none';
            alert(data.message);
            updateSummary();
          }
        })
        .catch(err => {
          console.error(err);
          applyVoucherBtn.disabled = false;
          applyVoucherBtn.textContent = 'Áp dụng';
          alert('Có lỗi xảy ra khi kiểm tra mã');
        });
    });
  }

  function updateSummary() {
    const vat = Math.round(selectedPlan.price * 0.1);
    let total = selectedPlan.price + vat;

    // Apply discount
    let discountAmount = 0;
    if (currentDiscount.type === 'fixed') {
      discountAmount = currentDiscount.value;
    } else if (currentDiscount.type === 'percent') {
      discountAmount = Math.round(selectedPlan.price * (currentDiscount.value / 100));
    }

    // Ensure discount doesn't exceed total
    if (discountAmount > total) discountAmount = total;

    total = total - discountAmount;

    if (discountValueEl) {
      discountValueEl.textContent = '-' + formatCurrency(discountAmount);
    }

    confirmPlan.textContent = selectedPlan.label;
    confirmTotal.textContent = formatCurrency(total);
    if (confirmPrice) confirmPrice.textContent = formatCurrency(selectedPlan.price);
    if (confirmVat) confirmVat.textContent = formatCurrency(vat);
  }

  function updatePlanBadgeFromStorage() {
    try {
      const stored = localStorage.getItem('hf_current_plan');
      if (stored && planBadge) {
        planBadge.textContent = stored;
        planBadge.classList.add('show');
      }
    } catch (_) { }
  }

  // Open/Close
  openBtn.addEventListener('click', (e) => { e.preventDefault(); open(); });
  closeBtn.addEventListener('click', close);
  overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

  // Goal Tabs
  const goalTabs = document.getElementById('goalTabs');
  const plansGroups = document.querySelectorAll('.plans-group');

  if (goalTabs) {
    goalTabs.addEventListener('click', (e) => {
      const tab = e.target.closest('.goal-tab');
      if (!tab) return;

      // Switch tabs
      goalTabs.querySelectorAll('.goal-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      // Switch content
      const goalId = tab.dataset.goal;
      plansGroups.forEach(g => {
        if (g.dataset.goalGroup === goalId) {
          g.classList.add('active');
        } else {
          g.classList.remove('active');
        }
      });
    });
  }

  // Plan selection
  const plansContainer = document.querySelector('.plans-container');
  if (plansContainer) {
    plansContainer.addEventListener('click', (e) => {
      const card = e.target.closest('.plan-card');
      if (!card) return;

      // Remove active class from all cards in all groups
      document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('active'));
      card.classList.add('active');

      selectedPlan = {
        key: String(card.dataset.plan || 'pro'),
        price: Number(card.dataset.price || '199000'),
        label: card.querySelector('.plan-title')?.textContent?.trim() || 'Pro',
      };
      updateSummary();
    });
  }

  // Actions (next/back/close)
  overlay.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;
    const action = btn.getAttribute('data-action');
    if (action === 'close') return close();
    if (action === 'next') return goToStep(Math.min(2, currentStep + 1));
    if (action === 'back') return goToStep(Math.max(1, currentStep - 1));
    if (action === 'pay') {
      // Mock payment success -> go to step 3 (success screen)
      btn.setAttribute('disabled', 'true');

      // Save plan to server
      fetch('/api/account/plan', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ plan: selectedPlan.label })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            setTimeout(() => {
              btn.removeAttribute('disabled');
              goToStep(3);
              successEl && successEl.classList.add('show');
              // Save current plan for navbar badge
              try { localStorage.setItem('hf_current_plan', selectedPlan.label); } catch (_) { }
              updatePlanBadgeFromStorage();
              // Auto-close modal after showing success (e.g., 3 seconds)
              setTimeout(() => {
                close();
                // Reload to update profile badge if on profile page
                if (window.location.pathname.includes('/profile')) {
                  window.location.reload();
                }
              }, 3000);
            }, 800);
          } else {
            alert('Có lỗi xảy ra khi lưu gói: ' + data.message);
            btn.removeAttribute('disabled');
          }
        })
        .catch(err => {
          console.error(err);
          alert('Có lỗi xảy ra khi kết nối server');
          btn.removeAttribute('disabled');
        });
    }
  });

  // Initialize
  updateSummary();
  updatePlanBadgeFromStorage();
})();
</script>

</body>
</html>