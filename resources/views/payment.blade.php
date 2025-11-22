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

        <div class="payment-body">
            <div class="payment-content">

                <!-- Stepper -->
                <div class="stepper" id="paymentStepper">
                    <div class="step active" data-step="1">
                        <span class="dot">1</span> Chọn gói
                    </div>
                    <div class="step-divider"></div>

                    <div class="step" data-step="2">
                        <span class="dot">2</span> Phương thức
                    </div>
                    <div class="step-divider"></div>

                    <div class="step" data-step="3">
                        <span class="dot">3</span> Xác nhận
                    </div>
                </div>

                <!-- Step 1: Plans -->
                <section class="step-panel" data-panel="1">
                    <div class="plans" id="planList">

                        <div class="plan-card" data-plan="basic" data-price="99000">
                            <div class="plan-title">Basic</div>
                            <div class="plan-price">99.000đ <span>/tháng</span></div>
                            <ul>
                                <li>• Bài tập cơ bản</li>
                                <li>• Kế hoạch dinh dưỡng mẫu</li>
                            </ul>
                            <p class="plan-desc">Phù hợp cho người mới bắt đầu hành trình sức khỏe.</p>
                        </div>

                        <div class="plan-card active" data-plan="pro" data-price="599000">
                            <div class="plan-title">Pro</div>
                            <div class="plan-price">599.000đ <span>/tháng</span></div>
                            <ul>
                                <li>• Toàn bộ nội dung nâng cao</li>
                                <li>• Theo dõi sức khỏe thông minh</li>
                                <li>• Cộng đồng riêng tư</li>
                            </ul>
                            <p class="plan-desc">Lựa chọn phổ biến nhất cho người tập nghiêm túc.</p>
                        </div>

                        <div class="plan-card" data-plan="premium" data-price="2999000">
                            <div class="plan-title">Premium</div>
                            <div class="plan-price">2.999.000đ <span>/tháng</span></div>
                            <ul>
                                <li>• Huấn luyện viên 1-1</li>
                                <li>• Thực đơn cá nhân hoá</li>
                                <li>• Ưu tiên hỗ trợ</li>
                            </ul>
                            <p class="plan-desc">Trải nghiệm đầy đủ và cao cấp nhất.</p>
                        </div>

                    </div>

                    <div class="payment-actions">
                        <button class="btn btn-secondary" data-action="close">Hủy</button>
                        <button class="btn btn-primary" data-action="next">Tiếp tục</button>
                    </div>
                </section>

                <!-- Step 2: Methods -->
                <section class="step-panel" data-panel="2" hidden>

                    <!-- Method tabs -->
                    <div class="methods" id="methodTabs">
                        <button class="method-btn active" data-method="card">
                            <i class="fa-regular fa-credit-card"></i> Thẻ
                        </button>
                        <button class="method-btn" data-method="wallet">
                            <i class="fa-solid fa-mobile-screen-button"></i> Ví điện tử
                        </button>
                        <button class="method-btn" data-method="qr">
                            <i class="fa-solid fa-qrcode"></i> QR
                        </button>
                    </div>

                    <!-- Card Payment -->
                    <div class="method-panel show" data-panel-method="card">
                        <div class="field">
                            <label>Họ và tên trên thẻ</label>
                            <input class="input" id="cardName" placeholder="NGUYEN VAN A">
                        </div>

                        <div class="field">
                            <label>Số thẻ</label>
                            <input class="input" id="cardNumber" inputmode="numeric" maxlength="19" placeholder="1234 5678 9012 3456">
                        </div>

                        <div class="row">
                            <div class="field">
                                <label>Hết hạn</label>
                                <input class="input" id="cardExpiry" inputmode="numeric" maxlength="5" placeholder="MM/YY">
                            </div>

                            <div class="field">
                                <label>CVV</label>
                                <input class="input" id="cardCvv" inputmode="numeric" maxlength="4" placeholder="***">
                            </div>
                        </div>
                    </div>

                    <!-- Wallet Payment -->
                    <div class="method-panel" data-panel-method="wallet">
                        <div class="field">
                            <label>Chọn ví</label>
                            <select class="select" id="walletType">
                                <option value="momo">MoMo</option>
                                <option value="zalopay">ZaloPay</option>
                                <option value="viettelpay">Viettel Money</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Số điện thoại ví</label>
                            <input class="input" id="walletPhone" inputmode="numeric" placeholder="09xxxxxxxx">
                        </div>
                    </div>

                    <!-- QR Payment -->
                    <div class="method-panel" data-panel-method="qr">
                        <div class="field">
                            <label>Chọn ví để quét QR</label>
                            <select class="select" id="qrWalletType">
                                <option value="momo">MoMo</option>
                                <option value="zalopay">ZaloPay</option>
                                <option value="viettelpay">Viettel Money</option>
                            </select>
                        </div>

                        <div class="summary-box">
                            <p>Quét mã để thanh toán bằng <strong id="qrWalletLabel">MoMo</strong>:</p>
                            <img id="qrImage" src="{{ asset('images/qr1.jpg') }}" alt="QR" style="max-width: 180px; border-radius: 10px;">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="payment-actions">
                        <button class="btn btn-secondary" data-action="back">Quay lại</button>
                        <button class="btn btn-primary" data-action="next">Tiếp tục</button>
                    </div>
                </section>

                <!-- Step 3: Confirm -->
                <section class="step-panel" data-panel="3" hidden>
                    <div class="confirm-table">
                        <div class="confirm-row"><span>Gói</span><strong id="confirmPlan">Pro</strong></div>
                        <div class="confirm-row"><span>Chu kỳ</span><span>1 tháng</span></div>
                        <div class="confirm-row"><span>Phương thức</span><span id="confirmMethod">Thẻ</span></div>
                        
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

                <!-- Step 4: Success -->
                <section class="step-panel" data-panel="4" hidden>
                    <div class="success-state show" id="paySuccess">
                        <div class="success-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="success-title">Thanh toán thành công!</div>
                        <div class="success-desc">Cảm ơn bạn đã tin tưởng HealthFit. Gói của bạn đã được kích hoạt.</div>
                    </div>
                </section>

            </div>

            <!-- Sidebar Summary -->
            <aside class="payment-summary" id="orderSummary">
                <h4 class="summary-title">Tóm tắt đơn hàng</h4>

                <div class="summary-box">
                    <div class="summary-item"><span>Gói đã chọn</span><strong id="sumPlan">Pro</strong></div>
                    <div class="summary-item"><span>Giá</span><span id="sumPrice">599.000đ</span></div>
                    <div class="summary-item"><span>VAT (10%)</span><span id="sumVat">19.900đ</span></div>
                    <div class="summary-total"><span>Tổng cộng</span><span id="sumTotal">218.900đ</span></div>
                </div>
            </aside>

        </div>
    </div>
</div>

<!-- Scripts -->
<script defer src="{{ asset('js/payment.js') }}"></script>
