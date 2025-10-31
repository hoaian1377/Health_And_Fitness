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
  let selectedMethod = 'card';

  // Elements
  const planList = document.getElementById('planList');
  const steps = Array.from(document.querySelectorAll('.step'));
  const panels = Array.from(document.querySelectorAll('.step-panel'));
  const methodTabs = document.getElementById('methodTabs');
  const methodPanels = Array.from(document.querySelectorAll('.method-panel'));
  const confirmPlan = document.getElementById('confirmPlan');
  const confirmTotal = document.getElementById('confirmTotal');
  const confirmMethod = document.getElementById('confirmMethod');
  const confirmPrice = document.getElementById('confirmPrice');
  const confirmVat = document.getElementById('confirmVat');
  const sumPlan = document.getElementById('sumPlan');
  const sumPrice = document.getElementById('sumPrice');
  const sumVat = document.getElementById('sumVat');
  const sumTotal = document.getElementById('sumTotal');
  const successEl = document.getElementById('paySuccess');
  // QR elements (optional)
  const qrWalletType = document.getElementById('qrWalletType');
  const qrWalletLabel = document.getElementById('qrWalletLabel');
  const qrImage = document.getElementById('qrImage');
  // Plan badge
  const planBadge = document.getElementById('planBadge');
  const orderSummary = document.getElementById('orderSummary');
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
    // Hide sidebar summary at confirmation step and switch to single column
    if (orderSummary) {
      orderSummary.style.display = step >= 3 ? 'none' : '';
    }
    if (paymentBody) {
      if (step >= 3) paymentBody.classList.add('single');
      else paymentBody.classList.remove('single');
    }
    // Hide stepper on step 4
    if (paymentStepper) {
      paymentStepper.style.display = step === 4 ? 'none' : '';
    }
    successEl && successEl.classList.remove('show');
  }

  function updateSummary() {
    const vat = Math.round(selectedPlan.price * 0.1);
    const total = selectedPlan.price + vat;
    sumPlan.textContent = selectedPlan.label;
    sumPrice.textContent = formatCurrency(selectedPlan.price);
    sumVat.textContent = formatCurrency(vat);
    sumTotal.textContent = formatCurrency(total);
    confirmPlan.textContent = selectedPlan.label;
    confirmTotal.textContent = formatCurrency(total);
    if (confirmPrice) confirmPrice.textContent = formatCurrency(selectedPlan.price);
    if (confirmVat) confirmVat.textContent = formatCurrency(vat);
    if (confirmMethod) {
      confirmMethod.textContent = selectedMethod === 'card' ? 'Thẻ' : selectedMethod === 'wallet' ? 'Ví điện tử' : 'QR';
    }
  }

  function updatePlanBadgeFromStorage() {
    try {
      const stored = localStorage.getItem('hf_current_plan');
      if (stored && planBadge) {
        planBadge.textContent = stored;
        planBadge.classList.add('show');
      }
    } catch (_) {}
  }

  // Open/Close
  openBtn.addEventListener('click', (e) => { e.preventDefault(); open(); });
  closeBtn.addEventListener('click', close);
  overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

  // Plan selection
  planList.addEventListener('click', (e) => {
    const card = e.target.closest('.plan-card');
    if (!card) return;
    planList.querySelectorAll('.plan-card').forEach((c) => c.classList.remove('active'));
    card.classList.add('active');
    selectedPlan = {
      key: String(card.dataset.plan || 'pro'),
      price: Number(card.dataset.price || '199000'),
      label: card.querySelector('.plan-title')?.textContent?.trim() || 'Pro',
    };
    updateSummary();
  });

  // Actions (next/back/close)
  overlay.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;
    const action = btn.getAttribute('data-action');
    if (action === 'close') return close();
    if (action === 'next') return goToStep(Math.min(3, currentStep + 1));
    if (action === 'back') return goToStep(Math.max(1, currentStep - 1));
    if (action === 'pay') {
      // Mock payment success -> go to step 4 (success screen)
      btn.setAttribute('disabled', 'true');
      setTimeout(() => {
        btn.removeAttribute('disabled');
        goToStep(4);
        successEl && successEl.classList.add('show');
        // Save current plan for navbar badge
        try { localStorage.setItem('hf_current_plan', selectedPlan.label); } catch (_) {}
        updatePlanBadgeFromStorage();
        // Auto-close modal after showing success (e.g., 3 seconds)
        setTimeout(() => {
          close();
        }, 3000);
      }, 800);
    }
  });

  // Method tabs
  methodTabs.addEventListener('click', (e) => {
    const tab = e.target.closest('.method-btn');
    if (!tab) return;
    const method = tab.dataset.method;
    methodTabs.querySelectorAll('.method-btn').forEach((t) => t.classList.remove('active'));
    tab.classList.add('active');
    methodPanels.forEach((p) => p.classList.toggle('show', p.dataset.panelMethod === method));
    selectedMethod = method;
    updateSummary();
  });

  // QR wallet selection -> swap label/image
  if (qrWalletType && qrWalletLabel && qrImage) {
    const walletToImage = {
      momo: '/images/qr1.jpg',
      zalopay: '/images/qr2.jpg',
      viettelpay: '/images/qr3.jpg',
    };
    const walletToLabel = {
      momo: 'MoMo',
      zalopay: 'ZaloPay',
      viettelpay: 'Viettel Money',
    };
    const updateQr = () => {
      const val = qrWalletType.value;
      qrWalletLabel.textContent = walletToLabel[val] || 'MoMo';
      qrImage.setAttribute('src', walletToImage[val] || walletToImage.momo);
    };
    qrWalletType.addEventListener('change', updateQr);
    // Initialize image/label to current selection
    updateQr();
  }

  // Light formatting for card inputs
  const cardNumber = document.getElementById('cardNumber');
  const cardExpiry = document.getElementById('cardExpiry');
  const onlyDigits = (s) => s.replace(/\D/g, '');

  cardNumber.addEventListener('input', () => {
    const v = onlyDigits(cardNumber.value).slice(0, 16);
    const groups = v.match(/.{1,4}/g) || [];
    cardNumber.value = groups.join(' ');
  });

  cardExpiry.addEventListener('input', () => {
    const v = onlyDigits(cardExpiry.value).slice(0, 4);
    if (v.length >= 3) cardExpiry.value = v.slice(0, 2) + '/' + v.slice(2);
    else cardExpiry.value = v;
  });

  // Initialize
  updateSummary();
  updatePlanBadgeFromStorage();
})();