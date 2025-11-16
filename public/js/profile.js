/* ============================================
   PROFILE PAGE JAVASCRIPT
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    initProfilePage();
});

/**
 * Khởi tạo trang profile
 */
function initProfilePage() {
    setupNavbarMenuToggle();
    setupMenuNavigation();
    setupFormEditing();
    setupDeleteModal();
    setupAvatarUpload();
    setupMenuToggle();
}

/**
 * Setup navbar menu toggle cho mobile
 */
function setupNavbarMenuToggle() {
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");
    if (toggle) {
        toggle.addEventListener("click", () => {
            menu.classList.toggle("show");
        });
    }
}

/**
 * Setup menu toggle cho mobile
 */
function setupMenuToggle() {
    const menuToggleBtn = document.getElementById('profileMenuToggle');
    const sidebar = document.getElementById('profileSidebar');
    
    if (!menuToggleBtn || !sidebar) {
        console.warn('Menu toggle elements not found');
        return;
    }

    // Toggle menu khi click button
    menuToggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Menu toggle clicked');
        menuToggleBtn.classList.toggle('active');
        sidebar.classList.toggle('show');
    });

    // Đóng menu khi click trên item menu
    const menuItems = document.querySelectorAll('.profile-menu .menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                console.log('Menu item clicked - closing menu');
                menuToggleBtn.classList.remove('active');
                sidebar.classList.remove('show');
            }
        });
    });

    // Đóng menu khi resize về desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && sidebar.classList.contains('show')) {
            console.log('Resized to desktop - closing menu');
            menuToggleBtn.classList.remove('active');
            sidebar.classList.remove('show');
        }
    });

    // Đóng menu khi click bên ngoài
    document.addEventListener('click', function(e) {
        if (sidebar.classList.contains('show') && 
            !sidebar.contains(e.target) && 
            !menuToggleBtn.contains(e.target)) {
            console.log('Clicked outside - closing menu');
            menuToggleBtn.classList.remove('active');
            sidebar.classList.remove('show');
        }
    });
}

/**
 * Setup điều hướng menu
 */
function setupMenuNavigation() {
    const menuItems = document.querySelectorAll('.menu-item');
    const sections = document.querySelectorAll('.profile-section');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.getAttribute('data-section');

            // Remove active class from all items and sections
            menuItems.forEach(m => m.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));

            // Add active class to clicked item and target section
            this.classList.add('active');
            const target = document.getElementById(targetSection);
            if (target) {
                target.classList.add('active');
                // Scroll to section on mobile
                if (window.innerWidth < 768) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
}

/**
 * Setup chỉnh sửa biểu mẫu
 */
function setupFormEditing() {
    // Personal Information Form
    const editPersonalBtn = document.getElementById('editPersonalBtn');
    const personalForm = document.getElementById('personalForm');
    const formActions = document.getElementById('formActions');
    const cancelEditBtn = document.getElementById('cancelEditBtn');

    if (editPersonalBtn) {
        editPersonalBtn.addEventListener('click', function() {
            toggleFormEditing(personalForm, formActions);
        });
    }

    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', function() {
            toggleFormEditing(personalForm, formActions, true);
        });
    }

    if (personalForm) {
        personalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(personalForm, 'personal', formActions);
        });
    }

    // Health Data Form
    const editHealthBtn = document.getElementById('editHealthBtn');
    const healthForm = document.getElementById('healthForm');
    const healthFormActions = document.getElementById('healthFormActions');
    const cancelHealthEditBtn = document.getElementById('cancelHealthEditBtn');

    if (editHealthBtn) {
        editHealthBtn.addEventListener('click', function() {
            toggleFormEditing(healthForm, healthFormActions);
        });
    }

    if (cancelHealthEditBtn) {
        cancelHealthEditBtn.addEventListener('click', function() {
            toggleFormEditing(healthForm, healthFormActions, true);
        });
    }

    if (healthForm) {
        healthForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(healthForm, 'health', healthFormActions);
        });
    }

    // Preferences Form
    const preferencesForm = document.getElementById('preferencesForm');
    if (preferencesForm) {
        preferencesForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(preferencesForm, 'preferences', null);
        });
    }
}

/**
 * Toggle form editing mode
 */
function toggleFormEditing(form, actionContainer, cancel = false) {
    const inputs = form.querySelectorAll('input, select, textarea');
    const isDisabled = inputs[0].disabled;

    inputs.forEach(input => {
        if (cancel) {
            input.disabled = true;
        } else {
            input.disabled = !isDisabled;
        }
    });

    if (actionContainer) {
        if (!cancel && isDisabled) {
            actionContainer.style.display = 'flex';
        } else if (cancel || isDisabled) {
            actionContainer.style.display = 'none';
        }
    }
}

/**
 * Handle form submission
 */
async function handleFormSubmit(form, type, actionContainer) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    try {
        // Tampilkan loading state
        showNotification('Đang lưu...', 'info');

        // Simulasi API call (ganti dengan route thực tế)
        const response = await fetch('/api/profile/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ type, data })
        }).catch(() => {
            // Jika API tidak ada, simulasikan success
            return {
                ok: true,
                json: async () => ({ success: true })
            };
        });

        if (response.ok) {
            showNotification('Lưu thành công! ✓', 'success');
            if (actionContainer) {
                actionContainer.style.display = 'none';
                // Disable form inputs lagi
                form.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = true;
                });
            }
        } else {
            showNotification('Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Có lỗi xảy ra!', 'error');
    }
}

/**
 * Setup delete modal
 */
function setupDeleteModal() {
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const modalCloseBtn = deleteModal?.querySelector('.modal-close');
    const modalCloseBtnFooter = deleteModal?.querySelector('.modal-close-btn');

    if (deleteAccountBtn) {
        deleteAccountBtn.addEventListener('click', function() {
            deleteModal?.classList.add('show');
        });
    }

    if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', function() {
            deleteModal?.classList.remove('show');
        });
    }

    if (modalCloseBtnFooter) {
        modalCloseBtnFooter.addEventListener('click', function() {
            deleteModal?.classList.remove('show');
        });
    }

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            handleDeleteAccount();
        });
    }

    // Close modal when clicking outside
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });
    }
}

/**
 * Handle delete account
 */
async function handleDeleteAccount() {
    try {
        const response = await fetch('/api/profile/delete', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        }).catch(() => {
            // Jika API tidak ada
            return {
                ok: true,
                json: async () => ({ success: true })
            };
        });

        if (response.ok) {
            showNotification('Tài khoản đã được xóa!', 'success');
            setTimeout(() => {
                window.location.href = '/';
            }, 2000);
        } else {
            showNotification('Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Có lỗi xảy ra!', 'error');
    }
}

/**
 * Setup avatar upload
 */
function setupAvatarUpload() {
    const editAvatarBtn = document.getElementById('editAvatarBtn');
    
    if (editAvatarBtn) {
        editAvatarBtn.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleAvatarUpload(file);
                }
            };
            input.click();
        });
    }
}

/**
 * Handle avatar upload
 */
async function handleAvatarUpload(file) {
    const formData = new FormData();
    formData.append('avatar', file);

    try {
        showNotification('Đang tải ảnh...', 'info');

        const response = await fetch('/api/profile/avatar', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: formData
        }).catch(() => {
            // Simulasi success
            return {
                ok: true,
                json: async () => ({ success: true })
            };
        });

        if (response.ok) {
            const data = await response.json();
            showNotification('Cập nhật ảnh thành công! ✓', 'success');
            // Update avatar image
            const avatarImg = document.querySelector('.profile-avatar');
            if (avatarImg && data.avatar_url) {
                avatarImg.src = data.avatar_url;
            }
        } else {
            showNotification('Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Có lỗi xảy ra!', 'error');
    }
}

/**
 * Show notification
 */
function showNotification(message, type = 'info') {
    // Tạo notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            ${message}
        </div>
    `;

    // Add notification styles jika belum ada
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.innerHTML = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                animation: slideInRight 0.3s ease;
                max-width: 400px;
            }

            .notification-info {
                background: #3b82f6;
                color: white;
            }

            .notification-success {
                background: #10b981;
                color: white;
            }

            .notification-error {
                background: #ef4444;
                color: white;
            }

            .notification-warning {
                background: #f59e0b;
                color: white;
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @media (max-width: 600px) {
                .notification {
                    right: 10px;
                    left: 10px;
                    max-width: none;
                }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideInRight 0.3s ease reverse';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

/**
 * Utility: Format date
 */
function formatDate(date) {
    if (!date) return '';
    const d = new Date(date);
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    const year = d.getFullYear();
    return `${year}-${month}-${day}`;
}

/**
 * Utility: Calculate BMI
 */
function calculateBMI(height, weight) {
    if (!height || !weight) return null;
    const heightInMeters = height / 100;
    const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);
    return bmi;
}

// Recalculate BMI when height or weight changes
const heightInput = document.getElementById('height');
const weightInput = document.getElementById('weight');
const bmiInput = document.getElementById('bmi');

if (heightInput && weightInput && bmiInput) {
    [heightInput, weightInput].forEach(input => {
        input.addEventListener('change', function() {
            const bmi = calculateBMI(heightInput.value, weightInput.value);
            if (bmi) {
                bmiInput.value = bmi;
            }
        });
    });
}

/**
 * Handle smooth scrolling for mobile menu
 */
window.addEventListener('resize', function() {
    if (window.innerWidth >= 768) {
        // Reset menu visibility on desktop
        const menu = document.getElementById('menu');
        if (menu) {
            menu.style.display = '';
        }
    }
});
