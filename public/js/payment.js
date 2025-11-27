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