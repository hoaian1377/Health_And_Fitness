@extends('base')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #9FCD3B;
    --primary-light: #D4F442;
    --secondary: #0EA5E9;
    --yellow: #FFE67E;
    --light-bg: #ffffffff;
    --light-card: #FFFFFF;
    --text-dark: #1A202C;
    --text-muted: #718096;
    --border-light: #E2E8F0;
    --success: #10B981;
    --warning: #F59E0B;
    --danger: #EF4444;
    --info: #3B82F6;
    --radius: 12px;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.05);
}


/* Ensure profile page content is not hidden under fixed navbar (profile.css only loaded on profile page) */
main.container {
    padding-top: 60px;
    padding-bottom: 80px;
    padding-left: 24px;
    padding-right: 24px;
    flex: 1;
}



html,
body {
    font-family: 'Segoe UI', 'Roboto', sans-serif;
    background: var(--light-bg);
    color: var(--text-dark);
    line-height: 1.6;
    height: 100%;
    display: flex;
    flex-direction: column;
}

body {
    padding: 0;
    margin: 0;
}

.container {
    max-width: 16000000000px;
    margin: 0 auto;
    padding: 0 12px;
}

/* Header Section */
.profile-header {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 18px;
    padding: 40px;
    margin-bottom: 32px;
    border: 1px solid var(--border-light);
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 28px;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.profile-avatar-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: 700;
    border: 4px solid var(--primary-light);
    box-shadow: 0 8px 24px rgba(159, 205, 59, 0.25);
    overflow: hidden;
    object-fit: cover;
    color: #000;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-basic-info {
    flex: 1;
}

.profile-name {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.profile-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    font-size: 14px;
}

.meta-item strong {
    color: var(--text-dark);
}

.profile-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    background: var(--primary);
    color: #000;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.badge.secondary {
    background: var(--secondary);
}

.profile-actions {
    display: flex;
    gap: 12px;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--light-card);
    border: 1px solid var(--border-light);
    color: var(--text-muted);
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 18px;
}

.action-btn:hover {
    background: var(--primary);
    color: #000;
    border-color: var(--primary);
    transform: scale(1.05);
}

/* Main Grid */
.profile-grid {
    display: grid;
    grid-template-columns: 300px 1fr 280px;
    gap: 24px;
    margin-bottom: 30px;
}

@media (max-width: 1200px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
}

/* Sidebar */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.card {
    background: var(--light-card);
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.card:hover {
    border-color: var(--primary);
    box-shadow: 0 8px 24px rgba(159, 205, 59, 0.15);
}

.card-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 16px;
    letter-spacing: 0.5px;
}

/* Main Grid */
.profile-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

@media (max-width: 1024px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }

    .profile-header {
        grid-template-columns: 1fr;
        text-align: center;
    }
}

/* Sidebar */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.card {
    background: var(--light-card);
    border: 1px solid var(--border-light);
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.card:hover {
    border-color: var(--primary);
    box-shadow: 0 8px 24px rgba(159, 205, 59, 0.15);
    transform: translateY(-2px);
}

.card-title {
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--text-dark);
    margin-bottom: 0;
    letter-spacing: 0.5px;
}

.card-subtitle {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 16px;
}

/* Stats Card */
.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.stat-box {
    background: rgba(159, 205, 59, 0.1);
    border: 1px solid rgba(159, 205, 59, 0.2);
    border-radius: 8px;
    padding: 12px;
    text-align: center;
}

.stat-label {
    font-size: 11px;
    color: var(--text-muted);
    margin-bottom: 6px;
}

.stat-value {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary);
}

/* Main Content */
.main-content {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Progress Section */
.progress-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

@media (max-width: 768px) {
    .progress-section {
        grid-template-columns: 1fr;
    }
}

.progress-card {
    position: relative;
    overflow: hidden;
}

.progress-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
}

.circle-progress {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.circle-bg {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: conic-gradient(var(--primary) 0deg,
            var(--primary) 268.2deg,
            rgba(159, 205, 59, 0.1) 268.2deg,
            rgba(159, 205, 59, 0.1) 360deg);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: inset 0 0 20px rgba(159, 205, 59, 0.1);
}

.circle-inner {
    width: calc(100% - 30px);
    height: calc(100% - 30px);
    border-radius: 50%;
    background: var(--card-bg);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.circle-value {
    font-size: 40px;
    font-weight: 700;
    color: var(--primary);
}

.circle-label {
    font-size: 12px;
    color: var(--text-muted);
}

/* Table Section */
.table-section {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background: rgba(159, 205, 59, 0.1);
    border-bottom: 2px solid var(--border-color);
}

.table th {
    padding: 16px;
    text-align: left;
    font-weight: 600;
    color: var(--primary);
    font-size: 12px;
    text-transform: uppercase;
}

.table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border-color);
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(159, 205, 59, 0.05);
}

.table-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.table-badge.active {
    background: rgba(16, 185, 129, 0.2);
    color: #10B981;
}

.table-badge.pending {
    background: rgba(245, 158, 11, 0.2);
    color: #F59E0B;
}

/* Activity Card */
.activity-card {
    display: flex;
    gap: 14px;
    padding: 16px;
    background: rgba(159, 205, 59, 0.05);
    border-radius: 8px;
    margin-bottom: 12px;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    flex-shrink: 0;
    font-size: 16px;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.activity-time {
    font-size: 12px;
    color: var(--text-muted);
}

.activity-value {
    font-weight: 600;
    color: var(--primary);
}

/* Chart Container */
.chart-container {
    position: relative;
    height: 300px;
    margin-top: 20px;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-primary {
    background: var(--primary);
    color: #000;
}

.btn-primary:hover {
    background: var(--primary-light);
    box-shadow: 0 6px 16px rgba(159, 205, 59, 0.3);
}

.btn-secondary {
    background: var(--card-bg);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-secondary:hover {
    background: var(--border-color);
}

.btn-danger {
    background: rgba(239, 68, 68, 0.2);
    color: #EF4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    background: rgba(239, 68, 68, 0.3);
}

/* Form Elements */
.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 14px;
}

.form-group select,
.form-group input {
    width: 100%;
    padding: 10px 12px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-primary);
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-group select:focus,
.form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(159, 205, 59, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .profile-header {
        padding: 24px;
        grid-template-columns: 1fr;
    }

    .card {
        padding: 16px;
    }

    .card-title {
        font-size: 12px;
    }
}

/* Helpers for inline styles moved to CSS */
.meta-extra {
    margin-top: 8px;
}

.meta-item--small {
    margin-bottom: 4px;
}

.highlight-strong {
    color: var(--primary);
}

.center-note {
    margin-top: 20px;
    text-align: center;
}

.note-small {
    color: var(--text-secondary);
    font-size: 13px;
    margin: 0;
}

.progress-wrap {
    margin-top: 20px;
}

.progress-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.progress-label {
    font-size: 13px;
    color: var(--text-secondary);
}

#progress-percent {
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
}

.progress-bar-outer {
    height: 12px;
    background: rgba(159, 205, 59, 0.1);
    border-radius: 6px;
    overflow: hidden;
}

#progress-bar {
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 6px;
    transition: width 0.6s ease;
}

.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 24px;
}

.btn-flex {
    flex: 1;
}

.summary-box {
    background: rgba(159, 205, 59, 0.1);
    border-radius: 8px;
    padding: 16px;
}

.exercise-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.exercise-list-empty {
    text-align: center;
    color: #718096;
    padding: 20px;
    font-size: 14px;
}

.exercise-list-item {
    background: rgba(159, 205, 59, 0.08);
    border: 1px solid rgba(159, 205, 59, 0.2);
    border-radius: 8px;
    padding: 12px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.exercise-name {
    font-weight: 600;
    color: var(--text-dark);
}

.exercise-meta {
    display: flex;
    align-items: center;
    gap: 12px;
}

.exercise-cal {
    color: #9FCD3B;
    font-weight: 600;
}

.exercise-remove {
    background: none;
    border: none;
    color: #EF4444;
    cursor: pointer;
    font-size: 16px;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.3s;
}

/* Additional helpers used in Blade */
.muted-strong {
    color: var(--text-primary);
}

.mb-20 {
    margin-bottom: 20px;
}

.hstack {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.mb-12 {
    margin-bottom: 12px;
}

.big-primary {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
}

.top-divider {
    border-top: 1px solid rgba(159, 205, 59, 0.2);
    padding-top: 12px;
}

.exercise-list-title {
    font-weight: 600;
    margin-bottom: 12px;
    color: var(--text-secondary);
    font-size: 12px;
    text-transform: uppercase;
}

.text-secondary {
    color: var(--text-secondary);
}

.small {
    font-size: 13px;
}

.goal-value {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-primary);
}

/* NEW Unified Dashboard Layout */
.dashboard-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    margin-bottom: 0;
    align-items: start;
}

@media (max-width: 1024px) {
    .dashboard-container {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        gap: 20px;
    }
}

.dashboard-section {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.section-middle {
    grid-column: 1;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.section-right {
    grid-column: 2;
    display: flex;
    flex-direction: column;
    gap: 24px;
    align-items: stretch;
}

/* Cards Below Profile */
.cards-below-profile {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

@media (max-width: 1024px) {
    .cards-below-profile {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

/* Grid layouts for middle section */
.cards-grid-top {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
}

.cards-grid-middle {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
}

@media (max-width: 1024px) {

    .cards-grid-top,
    .cards-grid-middle {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {

    .cards-grid-top,
    .cards-grid-middle {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

/* Activity compact section */
.activity-compact-section {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* Stretch activity cards in right column so they reach the bottom of middle column */
.section-right>.card {
    /* allow cards to grow and share available vertical space */
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
}

.section-right>.card.card-activity-large {
    /* top running activity card a bit larger */
    flex: 2 1 0;
}

.section-right>.card.card-compact-activity {
    /* compact activity cards smaller but flexible */
    flex: 1 1 0;
}

.section-right .activity-details-list {
    /* make details list scroll if content overflows */
    overflow: auto;
}

/* Keep old classes for backward compatibility */
.profile-grid-3col {
    display: grid;
    grid-template-columns: 300px 1fr 320px;
    gap: 24px;
    margin-bottom: 30px;
}

@media (max-width: 1400px) {
    .profile-grid-3col {
        grid-template-columns: 1fr;
    }
}

.sidebar-left {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.sidebar-right {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.main-content-3col {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Card Progress - Left Sidebar */
.card-progress {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    padding: 32px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-radius: 18px;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 24px;
}

.progress-info {
    flex: 1;
}

.progress-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    display: block;
    margin-bottom: 6px;
}

.progress-value {
    font-size: 36px;
    font-weight: 800;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 4px;
}

.progress-note {
    font-size: 12px;
    color: var(--text-muted);
}

.badge-filter {
    display: inline-block;
    background: #FFFACD;
    color: #333;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

.circle-progress-container {
    display: flex;
    justify-content: center;
    margin: 24px 0;
}

.progress-details {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #E5E7EB;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-size: 13px;
    color: var(--text-muted);
}

.detail-percent {
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
}

/* Meal Card */
.card-meal {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    overflow: hidden;
    padding: 0;
    display: flex;
    flex-direction: column;
    border-radius: 18px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.badge-primary {
    display: inline-block;
    background: var(--primary);
    color: #000;
    padding: 8px 16px;
    font-size: 12px;
    font-weight: 700;
    margin: 16px 16px 0 16px;
    border-radius: 6px;
}

.meal-image {
    width: 100%;
    height: 180px;
    overflow: hidden;
    margin: 12px 0 0 0;
}

.meal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.meal-content {
    padding: 16px;
}

.meal-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 6px;
}

.meal-description {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 12px;
}

.meal-score {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(159, 205, 59, 0.1);
    padding: 8px 12px;
    border-radius: 6px;
    margin-bottom: 12px;
}

.score-label {
    font-size: 12px;
    color: var(--text-muted);
}

.score-value {
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
}

.nutrition-bars {
    width: 100%;
    height: 4px;
    background: rgba(159, 205, 59, 0.2);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 12px;
}

.nutrition-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
}

.meal-nutrition {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    font-size: 11px;
    color: var(--text-muted);
    margin-bottom: 12px;
    text-align: center;
}

.btn-add-meal {
    width: 100%;
}

/* Cards Row - Middle Content */
.cards-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 1024px) {
    .cards-row {
        grid-template-columns: 1fr;
    }
}

/* Compact Cards */
.card-compact {
    padding: 20px;
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 16px;
}

.card-full {
    padding: 24px;
}

/* Gradient Cards */
.card-gradient-green {
    background: linear-gradient(135deg, #D4F442 0%, #A8E063 100%);
    border: none;
    box-shadow: 0 8px 24px rgba(159, 205, 59, 0.15);
    border-radius: 16px;
}

.card-gradient-blue {
    background: linear-gradient(135deg, #87CEEB 0%, #5DADE2 100%);
    border: none;
    box-shadow: 0 8px 24px rgba(14, 165, 233, 0.15);
    border-radius: 16px;
}

.card-header-compact {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.card-icon-large {
    font-size: 28px;
    color: #E85D75;
}

.card-title-compact {
    font-size: 16px;
    font-weight: 700;
    flex: 1;
    margin-left: 12px;
    margin-bottom: 0;
}

.card-menu {
    cursor: pointer;
}

.btn-menu {
    background: none;
    border: none;
    font-size: 20px;
    color: inherit;
    cursor: pointer;
    padding: 0;
}

.heartbeat-content {
    text-align: center;
}

.bpm-value {
    font-size: 42px;
    font-weight: 800;
    color: #333;
    line-height: 1;
    margin-bottom: 6px;
}

.bpm-unit {
    font-size: 16px;
    font-weight: 600;
}

.bpm-status {
    font-size: 14px;
    color: #666;
    margin-bottom: 12px;
}

.heartbeat-text {
    font-size: 13px;
    color: #555;
    margin-bottom: 16px;
}

.heartbeat-animation {
    width: 100%;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
}

.heartbeat-line {
    width: 100%;
    height: 30px;
}

.health-score-content {
    text-align: center;
}

.health-score-value {
    font-size: 42px;
    font-weight: 800;
    color: #333;
    line-height: 1;
    margin-bottom: 6px;
}

.health-score-label {
    font-size: 14px;
    color: #666;
    margin-bottom: 16px;
}

.health-score-bar {
    width: 100%;
    height: 8px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 150px;
}

.score-fill {
    height: 100%;
    background: linear-gradient(90deg, #4CAF50, #81C784);
    border-radius: 4px;
}

.health-score-text {
    font-size: 12px;
    color: #555;
}

/* Profile Info Card */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.card-title {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 0;
}

.profile-info-grid {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 16px;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border-light);
}

.info-item {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 16px;
    align-items: center;
}

.avatar-large {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    color: #000;
}

.info-content {
    flex: 1;
}

.info-name {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 6px;
}

.info-badges {
    display: flex;
    gap: 12px;
}

.badge-small {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
    color: #666;
}

.badge-small.points {
    color: var(--primary);
}

.stats-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.stat-info-item {
    text-align: center;
    padding: 16px;
    background: #F9FAFB;
    border-radius: 8px;
}

.stat-info-label {
    display: block;
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 6px;
}

.stat-info-value {
    display: block;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-dark);
}

/* Activity Detail Card */
.activity-detail-card {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 24px;
}

@media (max-width: 768px) {
    .activity-detail-card {
        grid-template-columns: 1fr;
    }
}

.activity-map {
    border-radius: 12px;
    overflow: hidden;
    height: 300px;
    background: #F0F4F8;
}

.map-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    color: #D0D5DD;
}

.activity-info-detail {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.activity-route {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}

.activity-time {
    font-size: 13px;
    color: var(--text-muted);
}

.activity-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.activity-stat {
    padding: 12px;
    background: #F9FAFB;
    border-radius: 8px;
}

.stat-title {
    display: block;
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 4px;
}

.stat-val {
    display: block;
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
}

/* Right Sidebar Activity Cards */
.card-activity {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 16px;
}

.activity-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.activity-icon-box {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #000;
}

.activity-header h3 {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}

.activity-badge-row {
    margin-bottom: 16px;
}

.badge-label {
    display: inline-block;
    background: var(--primary);
    color: #000;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
}

.activity-details-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.activity-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #E5E7EB;
}

.activity-detail:last-child {
    border-bottom: none;
}

.detail-key {
    font-size: 13px;
    color: var(--text-muted);
}

.detail-val {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
}

.card-compact-activity {
    padding: 16px;
}

.activity-header-compact {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.activity-info-line {
    display: flex;
    align-items: center;
    gap: 8px;
}

.label {
    font-size: 13px;
    color: var(--text-dark);
    font-weight: 600;
}

.badge-tag {
    display: inline-block;
    background: #FFE5B4;
    color: #333;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: 600;
}

.val {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
}

.activity-sub {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    padding: 8px 0;
    border-bottom: 1px solid #E5E7EB;
}

.activity-sub:last-child {
    border-bottom: none;
}

.sub-label {
    color: var(--text-muted);
}

.sub-val {
    font-weight: 600;
    color: var(--text-dark);
}

.sub-val-highlight {
    display: inline-block;
    background: #FFE5B4;
    color: #FF6B35;
    padding: 2px 6px;
    border-radius: 3px;
    font-weight: 600;
}

/* Card Profile Styles */
.card-profile {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 16px;
    padding: 28px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(159, 205, 59, 0.15);
    position: relative;
}

.header-menu-container {
    position: relative;
}

.btn-menu {
    background: none;
    border: none;
    font-size: 18px;
    color: var(--text-muted);
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-menu:hover {
    background: rgba(159, 205, 59, 0.1);
    color: var(--primary);
}

.profile-menu-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 8px;
    background: white;
    border: 1px solid var(--border-light);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.profile-menu-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.menu-item {
    width: 100%;
    padding: 12px 16px;
    background: none;
    border: none;
    text-align: left;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--text-dark);
    font-size: 14px;
    transition: all 0.3s ease;
    border-radius: 0;
}

.menu-item:first-child {
    border-radius: 12px 12px 0 0;
}

.menu-item:last-child {
    border-radius: 0 0 12px 12px;
}

.menu-item:hover {
    background: rgba(159, 205, 59, 0.1);
    color: var(--primary);
}

.menu-item i {
    width: 20px;
    text-align: center;
    color: var(--text-muted);
}

.menu-item:hover i {
    color: var(--primary);
}

/* Profile Header Section */
.profile-header-section {
    margin-bottom: 28px;
    padding-bottom: 24px;
    border-bottom: 1px solid rgba(159, 205, 59, 0.1);
}

.profile-avatar-wrapper {
    display: flex;
    align-items: center;
    gap: 20px;
}

.profile-avatar-wrapper .avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: 700;
    color: #000;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(159, 205, 59, 0.25);
    position: relative;
    overflow: hidden;
}

.avatar-upload-container {
    position: relative;
}

.avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: none;
}



.avatar-large {
    /* cursor: pointer; removed */
    transition: transform 0.3s ease;
}

/* .avatar-upload-container:hover .avatar-large {
    transform: scale(1.05);
} removed */

.profile-name-wrapper {
    flex: 1;
}

.profile-name-in-card {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 12px;
}

.info-badges {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.badge-small {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(159, 205, 59, 0.12);
    color: var(--primary);
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid rgba(159, 205, 59, 0.2);
}

.badge-small i {
    font-size: 11px;
}

.badge-small.points {
    background: rgba(239, 68, 68, 0.12);
    color: #EF4444;
    border-color: rgba(239, 68, 68, 0.2);
}

/* Unified Profile Table */
.profile-table-container {
    overflow-x: auto;
}

.profile-table {
    width: 100%;
    border-collapse: collapse;
}

.profile-table tbody tr {
    border-bottom: 1px solid rgba(159, 205, 59, 0.1);
    transition: all 0.3s ease;
}

.profile-table tbody tr:hover {
    background: rgba(159, 205, 59, 0.06);
    transform: translateX(4px);
}

.profile-table tbody tr:last-child {
    border-bottom: none;
}

.profile-table td {
    padding: 18px 16px;
    vertical-align: middle;
}

.table-label {
    font-size: 15px;
    color: var(--text-dark);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}

.table-label i {
    width: 20px;
    text-align: center;
    color: var(--primary);
    font-size: 16px;
}

.table-label span {
    flex: 1;
}

.table-value {
    font-size: 16px;
    font-weight: 700;
    color: var(--primary);
    text-align: right;
    padding-left: 20px;
}

.value-display {
    text-align: right;
}

/* Card Activity Detail */
.card-activity-detail {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 16px;
}

.activity-detail-card {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.activity-map {
    height: 150px;
    background: linear-gradient(135deg, rgba(159, 205, 59, 0.1), rgba(14, 165, 233, 0.1));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-placeholder {
    font-size: 48px;
    color: rgba(159, 205, 59, 0.3);
}

.activity-info-detail {
    flex: 1;
}

.activity-route {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.activity-time {
    font-size: 13px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 48px;
}

.activity-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.activity-stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.stat-title {
    font-size: 11px;
    color: var(--text-muted);
    text-transform: uppercase;
    font-weight: 600;
}

.stat-val {
    font-size: 14px;
    font-weight: 700;
    color: var(--primary);
}

/* Card Activity Large */
.card-activity-large {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 16px;
}

.activity-details-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.activity-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(159, 205, 59, 0.08);
}

.activity-detail:last-child {
    border-bottom: none;
}

.detail-key {
    font-size: 13px;
    color: var(--text-muted);
}

.detail-val {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
}

/* Extended Dashboard Layout - Removed, now integrated into main dashboard */

/* Workout Card */
.card-workout {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.workout-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 1024px) {
    .workout-content {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .card-workout {
        padding: 16px;
    }

    .workout-content {
        gap: 16px;
    }
}

.workout-input-section {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.workout-chart-section {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Weekly Stats Card */
.card-weekly-stats {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAFBFC 100%);
    border-radius: 18px;
    padding: 108px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.card-weekly-stats .chart-container {
    height: 250px;
}

@media (max-width: 768px) {
    .card-weekly-stats {
        padding: 16px;
    }

    .card-weekly-stats .chart-container {
        height: 200px;
    }
}

/* ================= COMPREHENSIVE MOBILE OPTIMIZATION ================= */
/* Mobile-first improvements for screens < 768px */

@media (max-width: 768px) {

    /* === LAYOUT === */
    .dashboard-container {
        grid-template-columns: 1fr !important;
        gap: 16px;
        margin-bottom: 0;
    }

    .section-left,
    .section-middle,
    .section-right {
        grid-column: auto !important;
    }

    /* === HEADER === */
    .profile-header {
        grid-template-columns: 1fr;
        padding: 24px 16px;
        margin-bottom: 20px;
        text-align: center;
        gap: 16px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        font-size: 40px;
    }

    .profile-name {
        font-size: 22px;
    }

    .profile-meta {
        justify-content: center;
        gap: 16px;
    }

    .profile-actions {
        justify-content: center;
    }

    /* === CARDS === */
    .card {
        border-radius: 12px;
        padding: 16px;
    }

    .cards-grid-top,
    .cards-grid-middle,
    .cards-grid-bottom {
        grid-template-columns: 1fr !important;
        gap: 12px;
    }

    /* === COMPACT CARDS === */
    .card-compact {
        padding: 14px;
    }

    .card-header-compact {
        flex-wrap: wrap;
        gap: 8px;
    }

    .card-title-compact {
        font-size: 14px;
    }

    .card-icon-large {
        font-size: 24px;
    }

    /* === PROFILE CARD === */
    .card-profile {
        padding: 20px;
    }

    .card-header {
        margin-bottom: 20px;
        padding-bottom: 16px;
    }

    .profile-header-section {
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .profile-avatar-wrapper {
        gap: 16px;
    }

    .profile-avatar-wrapper .avatar-large {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }

    .profile-name-in-card {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .profile-table td {
        padding: 14px 12px;
        font-size: 14px;
    }

    .table-label {
        font-size: 14px;
        gap: 10px;
    }

    .table-label i {
        font-size: 14px;
        width: 18px;
    }

    .table-value {
        font-size: 14px;
        padding-left: 12px;
    }

    .badge-small {
        font-size: 11px;
        padding: 5px 10px;
    }

    /* === ACTIVITY DETAIL === */
    .card-activity-detail {
        padding: 16px;
    }

    .activity-detail-card {
        gap: 12px;
    }

    .activity-map {
        height: 120px;
    }

    .activity-route {
        font-size: 14px;
    }

    .activity-stats-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .stat-title {
        font-size: 10px;
    }

    .stat-val {
        font-size: 12px;
    }

    /* === ACTIVITY CARDS === */
    .card-activity-large {
        padding: 16px;
    }

    .activity-header {
        gap: 10px;
    }

    .activity-icon-box {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    .activity-details-list {
        gap: 10px;
    }

    .activity-detail {
        padding: 8px 0;
        font-size: 12px;
    }

    .detail-key {
        font-size: 11px;
    }

    .detail-val {
        font-size: 12px;
    }

    /* === WORKOUT SECTION === */
    .card-workout {
        padding: 16px;
    }

    .workout-content {
        grid-template-columns: 1fr !important;
        gap: 16px;
    }

    .workout-input-section {
        gap: 12px;
    }

    .form-group label {
        font-size: 12px;
    }

    .form-group select,
    .form-group input {
        padding: 8px 10px;
        font-size: 12px;
    }

    .btn {
        padding: 8px 12px;
        font-size: 12px;
        gap: 6px;
    }

    .hstack {
        gap: 8px;
        margin-bottom: 12px;
    }

    .summary-box {
        padding: 12px;
    }

    .big-primary {
        font-size: 24px;
    }

    .goal-value {
        font-size: 14px;
    }

    /* === WEEKLY STATS === */
    .card-weekly-stats {
        padding: 16px;
    }

    .card-weekly-stats .chart-container {
        height: 200px;
    }




    /* === CONTAINER === */
    .container {
        padding: 0 12px;
    }

    main.container {
        padding-left: 12px;
        padding-right: 12px;
        padding-top: 70px;
    }

    /* === PROGRESS CIRCLE === */
    .circle-progress {
        width: 140px;
        height: 140px;
    }

    .circle-value {
        font-size: 32px;
    }

    .progress-label {
        font-size: 11px;
    }

    .progress-value {
        font-size: 28px;
    }

    .detail-item {
        padding: 8px 0;
        font-size: 12px;
    }

    .detail-label {
        font-size: 11px;
    }

    .detail-percent {
        font-size: 12px;
    }

    /* === MEAL CARD === */
    .meal-image {
        height: 140px;
        margin: 8px 0 0 0;
    }

    .meal-content {
        padding: 12px;
    }

    .meal-title {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .meal-description {
        font-size: 11px;
    }

    .meal-nutrition {
        font-size: 11px;
    }

    .btn-add-meal {
        padding: 8px 12px;
        font-size: 11px;
    }

    /* === EXERCISE LIST === */
    .exercise-list-item {
        padding: 10px 12px;
        font-size: 12px;
    }

    .exercise-name {
        font-size: 12px;
    }

    .exercise-cal {
        font-size: 11px;
    }

    /* === SPACING TWEAKS === */
    .mb-20 {
        margin-bottom: 12px;
    }

    .mb-12 {
        margin-bottom: 8px;
    }

    .top-divider {
        padding-top: 8px;
    }

    /* === HEARTBEAT ANIMATION === */
    .heartbeat-animation {
        height: 30px;
    }

    /* === HEALTH SCORE === */
    .health-score-value {
        font-size: 28px;
    }

    .health-score-label {
        font-size: 12px;
    }

    .health-score-text {
        font-size: 11px;
    }

    /* === BADGE/LABELS === */
    .badge-primary {
        padding: 6px 12px;
        font-size: 11px;
        margin: 12px 0 0 0;
    }

    .badge-filter {
        padding: 5px 10px;
        font-size: 11px;
    }

    /* === CHART CONTAINERS === */
    .chart-container {
        height: auto;
        min-height: 200px;
    }

    /* === TEXT SIZING === */
    .small {
        font-size: 11px;
    }

    .text-secondary {
        font-size: 11px;
    }

    /* === ACTIVITY BADGE ROW === */
    .activity-badge-row {
        gap: 6px;
        margin-bottom: 12px;
    }

    .badge-label {
        padding: 5px 10px;
        font-size: 10px;
    }
}

/* === EXTRA SMALL SCREENS (< 480px) === */
@media (max-width: 480px) {

    /* === HEADER === */
    .profile-header {
        padding: 16px 12px;
        gap: 12px;
        margin-bottom: 16px;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }

    .profile-name {
        font-size: 18px;
    }

    .profile-meta {
        font-size: 12px;
        gap: 12px;
    }

    /* === CARDS === */
    .card {
        padding: 12px;
        border-radius: 10px;
    }

    .card-title {
        font-size: 12px;
    }

    /* === BUTTONS === */
    .btn {
        padding: 7px 10px;
        font-size: 11px;
    }

    /* === MAIN CONTAINER === */
    main.container {
        padding: 60px 10px 0 10px;
    }

    .container {
        padding: 0 10px;
    }

    /* === NAVBAR === */




    /* === CIRCLE PROGRESS === */
    .circle-progress {
        width: 100px;
        height: 100px;
    }

    .circle-value {
        font-size: 24px;
    }

    .circle-inner {
        width: calc(100% - 16px);
        height: calc(100% - 16px);
    }

    /* === CARDS GRID === */
    .cards-grid-top,
    .cards-grid-middle,
    .cards-grid-bottom {
        gap: 10px;
    }

    /* === MEAL IMAGE === */
    .meal-image {
        height: 120px;
    }

    /* === ACTIVITY CARD === */
    .activity-detail {
        padding: 6px 0;
        font-size: 11px;
    }

    .activity-route {
        font-size: 12px;
    }

    /* === WORKOUT === */
    .workout-content {
        gap: 12px;
    }

    .summary-box {
        padding: 10px;
    }

    .big-primary {
        font-size: 20px;
    }

    /* === STAT ITEMS === */
    .stat-info-item {
        padding: 8px 0;
        font-size: 11px;
    }

    .stat-info-label {
        font-size: 10px;
    }

    .stat-info-value {
        font-size: 11px;
    }
}

/* Responsive adjustments for profile table */
@media (max-width: 768px) {
    .profile-table {
        font-size: 13px;
    }

    .profile-table td {
        padding: 12px 10px;
    }

    .profile-avatar-wrapper {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .profile-name-wrapper {
        text-align: center;
    }

    .info-badges {
        justify-content: center;
    }

    .table-value {
        text-align: left;
        padding-left: 0;
    }

    .table-label {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }

    .table-label i {
        width: auto;
    }

    .avatar-overlay {
        opacity: 1;
        background: rgba(0, 0, 0, 0.6);
    }

    .profile-menu-dropdown {
        right: 0;
        left: auto;
    }
}

/* Notification Styles */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }

    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }

    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

/* Edit Profile Modal */
.edit-profile-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.edit-profile-modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 18px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    transform: scale(0.9);
    transition: transform 0.3s ease;
}

.edit-profile-modal.show .modal-content {
    transform: scale(1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px;
    border-bottom: 1px solid var(--border-light);
}

.modal-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    color: var(--text-muted);
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.3s ease;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #EF4444;
}

.edit-profile-form {
    padding: 24px;
}

.edit-profile-form .form-group {
    margin-bottom: 20px;
}

.edit-profile-form .form-group label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.edit-profile-form .form-group label i {
    color: var(--primary);
    width: 20px;
    text-align: center;
}

.edit-profile-form .form-group input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    font-size: 15px;
    color: var(--text-dark);
    transition: all 0.3s ease;
    font-family: inherit;
}

.edit-profile-form .form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(159, 205, 59, 0.1);
}

.modal-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border-light);
}

.modal-actions .btn {
    flex: 1;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: none;
}

.btn-cancel {
    background: #F3F4F6;
    color: var(--text-dark);
}

.btn-cancel:hover {
    background: #E5E7EB;
}

.btn-save {
    background: var(--primary);
    color: #000;
}

.btn-save:hover {
    background: var(--primary-light);
    box-shadow: 0 4px 12px rgba(159, 205, 59, 0.3);
}

.btn-save:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        max-height: 95vh;
    }

    .modal-header {
        padding: 20px;
    }

    .edit-profile-form {
        padding: 20px;
    }

    .modal-actions {
        flex-direction: column;
    }

    .modal-actions .btn {
        width: 100%;
    }
}
    </style>
</head>
<body>
 
<div class="container">
   

    <!-- Main Dashboard Container -->
    <div class="dashboard-container">
        <!-- Middle Section - Profile Table and Cards Below -->
        <div class="dashboard-section section-middle">
            <!-- My Profile Card with Unified Table -->
            <div class="card card-profile">
                <div class="card-header">
                    <h3 class="card-title">Hồ sơ của tôi</h3>
                    <div class="header-menu-container">
                        <button class="btn-menu" id="profile-menu-btn"><i class="fas fa-ellipsis-h"></i></button>
                        <div class="profile-menu-dropdown" id="profile-menu-dropdown">
                            <button class="menu-item" id="change-avatar-btn">
                                <i class="fas fa-camera"></i>
                                <span>Thay đổi ảnh đại diện</span>
                            </button>
                            <button class="menu-item" id="edit-profile-btn">
                                <i class="fas fa-edit"></i>
                                <span>Chỉnh sửa hồ sơ</span>
                            </button>
                            <a href="{{ route('password.change') }}" class="menu-item" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-key"></i>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile-header-section">
                    <div class="profile-avatar-wrapper">
                        <div class="avatar-upload-container">
                            <div class="avatar-large" id="avatar-display">
                                @if(isset($account->avatar) && $account->avatar)
                                    <img src="{{ asset('storage/' . $account->avatar) }}" alt="Avatar" id="avatar-img" style="display: block;">
                                    <span id="avatar-initial" style="display: none;">{{ substr($account->fullname, 0, 1) }}</span>
                                @else
                                    <img src="" alt="Avatar" id="avatar-img" style="display: none;">
                                    <span id="avatar-initial">{{ substr($account->fullname, 0, 1) }}</span>
                                @endif
                            </div>
                            <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                        </div>
                        <div class="profile-name-wrapper">
                            <h4 class="profile-name-in-card" id="profile-name-display">{{ $account->fullname }}</h4>
                            <div class="info-badges">
                                <span class="badge-small"><i class="fas fa-shield-alt"></i> {{ $userPlan ?? $account->plan ?? 'Chưa đăng ký' }}</span>
                                <span class="badge-small points"><i class="fas fa-fire"></i> 14,750 điểm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-table-container">
                    <table class="profile-table">
                        <tbody>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-user"></i>
                                    <span>Họ và tên</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="fullname-display">{{ $account->fullname }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-weight"></i>
                                    <span>Cân nặng</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="weight-display">{{ $account->weight ?? '0' }} kg</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-ruler-vertical"></i>
                                    <span>Chiều cao</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="height-display">{{ $account->height ?? '0' }} cm</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span>Tuổi</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="age-display">{{ $age }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Profile Modal -->
            <div class="edit-profile-modal" id="edit-profile-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Chỉnh sửa hồ sơ</h3>
                        <button class="modal-close" id="close-edit-modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form id="edit-profile-form" class="edit-profile-form">
                        <div class="form-group">
                            <label for="edit-fullname">
                                <i class="fas fa-user"></i>
                                Họ và tên
                            </label>
                            <input type="text" id="edit-fullname" name="fullname" value="{{ $account->fullname }}" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-weight">
                                <i class="fas fa-weight"></i>
                                Cân nặng (kg)
                            </label>
                            <input type="number" id="edit-weight" name="weight" value="{{ $account->weight ?? '' }}" step="0.01" min="10" max="500" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-height">
                                <i class="fas fa-ruler-vertical"></i>
                                Chiều cao (cm)
                            </label>
                            <input type="number" id="edit-height" name="height" value="{{ $account->height ?? '' }}" step="0.01" min="50" max="250" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-birthday">
                                <i class="fas fa-birthday-cake"></i>
                                Ngày sinh
                            </label>
                            <input type="date" id="edit-birthday" name="birthday" value="{{ $account->birthday ? date('Y-m-d', strtotime($account->birthday)) : '' }}" required>
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn btn-cancel" id="cancel-edit-btn">Hủy</button>
                            <button type="submit" class="btn btn-save">
                                <i class="fas fa-save"></i>
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Food List Modal -->
            <div class="edit-profile-modal" id="food-list-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content" style="max-width: 600px;">
                    <div class="modal-header">
                        <h3 class="modal-title">Chọn món ăn</h3>
                        <button class="modal-close" id="close-food-modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 20px; max-height: 400px; overflow-y: auto;">
                        <div id="food-list-container" class="food-list-grid">
                            <!-- Items will be loaded here -->
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin"></i> Đang tải...
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-weight: 600; color: #2d3748;">
                            Tổng đã chọn: <span id="selected-total-cal" style="color: #e53e3e;">0</span> kcal
                        </div>
                        <button class="btn btn-primary" id="save-selected-food-btn">
                            <i class="fas fa-save"></i> Lưu đã chọn
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cards Below Profile -->
            <div class="cards-below-profile">
                <!-- Progress Card -->
                <div class="card card-progress">
                    <div class="progress-header">
                        <div class="progress-info">
                            <div class="progress-label">Tiến độ</div>
                            <div class="progress-value" id="progress-percentage">{{ $progressPercentage ?? 0 }}%</div>
                            <div class="progress-note">Hoàn thành mục tiêu</div>
                        </div>
                        <div class="badge-filter">Tuần này</div>
                    </div>
                    <div class="circle-progress-container">
                        <div class="circle-progress">
                            <div class="circle-bg" id="circle-progress-bg" style="background: conic-gradient(
                                var(--primary) 0deg,
                                var(--primary) {{ ($progressPercentage ?? 0) * 3.6 }}deg,
                                rgba(159, 205, 59, 0.1) {{ ($progressPercentage ?? 0) * 3.6 }}deg,
                                rgba(159, 205, 59, 0.1) 360deg
                            );">
                                <div class="circle-inner">
                                    <div class="circle-value" id="circle-progress-value">{{ $progressPercentage ?? 0 }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-details">
                        <div class="detail-item">
                            <span class="detail-label">Tập cardio</span>
                            <span class="detail-percent">{{ $cardioProgress ?? 0 }}%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tập sức mạnh</span>
                            <span class="detail-percent">{{ $strengthProgress ?? 0 }}%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tăng linh hoạt</span>
                            <span class="detail-percent">{{ $flexibilityProgress ?? 0 }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Meal Card -->
                <div class="card card-meal" style="position: relative;">
                    @if($mealPlan)
                        <div class="badge-primary">Bữa ăn</div>
                        <div class="meal-image">
                            @if($mealPlan->urls)
                                <img src="{{ asset($mealPlan->urls) }}" alt="{{ $mealPlan->meal_name }}" onerror="this.src='{{ asset('images/meal1.avif') }}'">
                            @else
                                <img src="{{ asset('images/meal1.avif') }}" alt="{{ $mealPlan->meal_name }}">
                            @endif
                        </div>
                        <div class="meal-content">
                            <h3 class="meal-title">{{ $mealPlan->meal_name }}</h3>
                            <p class="meal-description">{{ $mealPlan->description ?? 'Bữa ăn dinh dưỡng và lành mạnh' }}</p>
                            
                            <!-- Calorie Progress Section -->
                            <div class="meal-score" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="score-label">Tiến độ calo:</span>
                                <span class="score-value" style="color: #e53e3e;">
                                    <span id="total-consumed-display">{{ $caloriesConsumedToday ?? 0 }}</span>/{{ $goal_calories }} kcal
                                </span>
                            </div>
                            <div class="nutrition-bars" style="background: #edf2f7; border-radius: 10px; height: 8px; overflow: hidden; margin-bottom: 15px;">
                                <div id="calorie-progress-bar" class="nutrition-bar" style="width: {{ min(100, round((($caloriesConsumedToday ?? 0) / $goal_calories) * 100)) }}%; background: linear-gradient(90deg, #FF9966, #FF5E62); height: 100%; border-radius: 10px; transition: width 0.5s ease;"></div>
                            </div>

                            <div class="meal-nutrition">
                                <span>{{ $mealPlan->calories ?? 450 }} Cal</span>
                                <span>{{ $mealPlan->carbs ?? 40 }}g Carbs</span>
                                <span>{{ $mealPlan->protein ?? 35 }}g Protein</span>
                                <span>{{ $mealPlan->fat ?? 15 }}g Fats</span>
                            </div>
                            <button class="btn btn-primary btn-sm mt-3" id="add-meal-btn" data-calories="{{ $mealPlan->calories ?? 450 }}" data-name="{{ $mealPlan->meal_name }}">
                                <i class="fas fa-plus"></i> Thêm bữa ăn
                            </button>
                        </div>
                    @else
                        <div class="badge-primary">Bữa ăn</div>
                        <div class="meal-image">
                            <img src="{{ asset('images/meal1.avif') }}" alt="Lean & Green">
                        </div>
                        <div class="meal-content">
                            <h3 class="meal-title">Lean &amp; Green</h3>
                            <p class="meal-description">Cá hồi nướng cùng bông cải hấp và cơm gạo lứt</p>
                            
                            <!-- Calorie Progress Section -->
                            <div class="meal-score" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="score-label">Tiến độ calo:</span>
                                <span class="score-value" style="color: #e53e3e;">
                                    <span id="total-consumed-display">{{ $caloriesConsumedToday ?? 0 }}</span>/{{ $goal_calories }} kcal
                                </span>
                            </div>
                            <div class="nutrition-bars" style="background: #edf2f7; border-radius: 10px; height: 8px; overflow: hidden; margin-bottom: 15px;">
                                <div id="calorie-progress-bar" class="nutrition-bar" style="width: {{ min(100, round((($caloriesConsumedToday ?? 0) / $goal_calories) * 100)) }}%; background: linear-gradient(90deg, #FF9966, #FF5E62); height: 100%; border-radius: 10px; transition: width 0.5s ease;"></div>
                            </div>

                            <div class="meal-nutrition">
                                <span>450 Cal</span>
                                <span>40g Carbs</span>
                                <span>35g Protein</span>
                                <span>15g Fats</span>
                            </div>
                            <button class="btn btn-primary btn-sm mt-3" id="add-meal-btn-default" data-calories="450" data-name="Lean & Green">
                                <i class="fas fa-plus"></i> Thêm bữa ăn
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Section - Top Right Cards -->
        <div class="dashboard-section section-right">
            <!-- Workout Section -->
            <div class="card card-workout">
                <div class="card-title mb-20">Bài tập hôm nay</div>
                
                <div class="workout-content">
                    <!-- Exercise Input Left -->
                    <div class="workout-input-section">
                        <div class="form-group">
                            <label>Chọn bài tập</label>
                            <select id="exercise-select">
                                <option value="">-- Chọn bài tập --</option>
                                @foreach($exercises as $ex)
                                    <option value="{{ $ex->calories_burned }}">{{ $ex->name_workout }} ({{ $ex->calories_burned }} kcal)</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="hstack">
                            <button class="btn btn-primary btn-flex" id="add-ex">
                                <i class="fas fa-plus"></i> Thêm
                            </button>
                            <button class="btn btn-danger" id="reset-ex">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <div class="summary-box">
                            <div class="mb-12">
                                <span class="text-secondary small">Tổng calo hôm nay</span>
                                <div class="big-primary">
                                    <span id="total-cal">0</span> <span class="small">kcal</span>
                                </div>
                            </div>
                            <div class="top-divider">
                                <span class="text-secondary small">Mục tiêu calo</span>
                                <div class="goal-value">
                                    <span id="goal-cal">{{ $goal_calories }}</span> kcal
                                </div>
                            </div>
                        </div>

                        <!-- Exercise List -->
                        <div style="margin-top: 20px;">
                            <div class="exercise-list-title">Danh sách bài tập</div>
                            <div id="exercise-list" class="exercise-list"></div>
                        </div>
                    </div>

                    <!-- Exercise Chart Right -->
                    <div class="workout-chart-section">
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Stats Section -->
            <div class="card card-weekly-stats">
                <div class="card-title mb-20">Calo tuần này</div>
                <div class="chart-container">
                    <canvas id="weekChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        window.profileData = {
            goalCalories: {{ $goal_calories }},
            caloriesBurnedToday: {{ $caloriesBurnedToday ?? 0 }},
            caloriesConsumedToday: {{ $caloriesConsumedToday ?? 0 }},
            userId: {{ Auth::id() }},
            date: '{{ \Carbon\Carbon::today()->format("Y-m-d") }}',
            weeklyCalories: @json($weeklyCalories ?? [])
        };
    </script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script>
        // Profile Edit Functionality
        (function() {
            // Avatar Upload
            const avatarInput = document.getElementById('avatar-input');
            const avatarDisplay = document.getElementById('avatar-display');
            const avatarImg = document.getElementById('avatar-img');
            const avatarInitial = document.getElementById('avatar-initial');
            const avatarOverlay = avatarDisplay.querySelector('.avatar-overlay');

            const changeAvatarBtn = document.getElementById('change-avatar-btn');

            if (changeAvatarBtn && avatarInput) {
                changeAvatarBtn.addEventListener('click', () => {
                    avatarInput.click();
                    // Close dropdown
                    if (menuDropdown) menuDropdown.classList.remove('show');
                });

                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Validate file
                    if (!file.type.match('image.*')) {
                        alert('Vui lòng chọn file ảnh hợp lệ!');
                        return;
                    }

                    if (file.size > 2048 * 1024) {
                        alert('Kích thước ảnh không được vượt quá 2MB!');
                        return;
                    }

                    // Preview image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (avatarImg) {
                            avatarImg.src = e.target.result;
                            avatarImg.style.display = 'block';
                            if (avatarInitial) avatarInitial.style.display = 'none';
                        } else {
                            const img = document.createElement('img');
                            img.id = 'avatar-img';
                            img.src = e.target.result;
                            img.alt = 'Avatar';
                            avatarDisplay.appendChild(img);
                            if (avatarInitial) avatarInitial.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);

                    // Upload to server
                    const formData = new FormData();
                    formData.append('avatar', file);

                    fetch('/profile/avatar', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: formData,
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (avatarImg) {
                                avatarImg.src = data.avatar_url;
                                avatarImg.style.display = 'block';
                                if (avatarInitial) avatarInitial.style.display = 'none';
                            } else {
                                const img = document.createElement('img');
                                img.id = 'avatar-img';
                                img.src = data.avatar_url;
                                img.alt = 'Avatar';
                                img.style.display = 'block';
                                avatarDisplay.appendChild(img);
                                if (avatarInitial) avatarInitial.style.display = 'none';
                            }
                            showNotification('Cập nhật avatar thành công!', 'success');
                            
                            // Update navbar avatar immediately
                            const navAvatar = document.querySelector('.user-trigger .user-avatar');
                            if (navAvatar) {
                                navAvatar.src = data.avatar_url;
                            }
                        } else {
                            showNotification(data.message || 'Có lỗi xảy ra!', 'error');
                            // Revert preview on error
                            if (avatarImg) {
                                avatarImg.style.display = 'none';
                                if (avatarInitial) avatarInitial.style.display = '';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Có lỗi xảy ra khi upload ảnh!', 'error');
                    });
                });
            }

            // Profile Menu Dropdown
            const menuBtn = document.getElementById('profile-menu-btn');
            const menuDropdown = document.getElementById('profile-menu-dropdown');
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const editModal = document.getElementById('edit-profile-modal');
            const closeModalBtn = document.getElementById('close-edit-modal');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const editForm = document.getElementById('edit-profile-form');

            // Toggle dropdown menu
            if (menuBtn && menuDropdown) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menuDropdown.classList.toggle('show');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!menuBtn.contains(e.target) && !menuDropdown.contains(e.target)) {
                        menuDropdown.classList.remove('show');
                    }
                });
            }

            // Open edit modal
            if (editProfileBtn && editModal) {
                editProfileBtn.addEventListener('click', function() {
                    menuDropdown.classList.remove('show');
                    editModal.classList.add('show');
                });
            }

            // Close modal
            function closeModal() {
                if (editModal) {
                    editModal.classList.remove('show');
                }
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', closeModal);
            }

            // Close modal when clicking overlay
            const modalOverlay = document.querySelector('.modal-overlay');
            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeModal);
            }

            // Handle form submit
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = {
                        fullname: document.getElementById('edit-fullname').value.trim(),
                        weight: parseFloat(document.getElementById('edit-weight').value),
                        height: parseFloat(document.getElementById('edit-height').value),
                        birthday: document.getElementById('edit-birthday').value
                    };

                    // Validation
                    if (!formData.fullname) {
                        showNotification('Vui lòng nhập họ và tên!', 'error');
                        return;
                    }

                    if (formData.weight < 10 || formData.weight > 500) {
                        showNotification('Cân nặng phải từ 10 đến 500 kg!', 'error');
                        return;
                    }

                    if (formData.height < 50 || formData.height > 250) {
                        showNotification('Chiều cao phải từ 50 đến 250 cm!', 'error');
                        return;
                    }

                    if (!formData.birthday) {
                        showNotification('Vui lòng chọn ngày sinh!', 'error');
                        return;
                    }

                    // Disable submit button
                    const submitBtn = editForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lưu...';

                    // Send request
                    fetch('/profile/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify(formData),
                        credentials: 'same-origin'
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || 'Server error');
                            });
                        }
                        return response.json();
                    })
                    .then(result => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;

                        if (result.success) {
                            // Update display values
                            document.getElementById('profile-name-display').textContent = formData.fullname;
                            document.getElementById('fullname-display').textContent = formData.fullname;
                            document.getElementById('weight-display').textContent = formData.weight + ' kg';
                            document.getElementById('height-display').textContent = formData.height + ' cm';
                            
                            // Calculate and update age
                            const age = calculateAge(formData.birthday);
                            document.getElementById('age-display').textContent = age;

                            // Update avatar initial if needed
                            const avatarInitial = document.getElementById('avatar-initial');
                            const avatarImg = document.getElementById('avatar-img');
                            if (avatarInitial && (!avatarImg || avatarImg.style.display === 'none')) {
                                avatarInitial.textContent = formData.fullname.charAt(0).toUpperCase();
                            }

                            showNotification('Cập nhật hồ sơ thành công!', 'success');
                            
                            // Update navbar name immediately
                            const navName = document.querySelector('.user-trigger span');
                            if (navName) {
                                navName.textContent = formData.fullname;
                            }
                            closeModal();
                            
                            // Reload page after 1 second to ensure all data is synced
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            const errorMsg = result.message || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Có lỗi xảy ra!');
                            showNotification(errorMsg, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        showNotification(error.message || 'Có lỗi xảy ra khi cập nhật!', 'error');
                    });
                });
            }

            function calculateAge(birthday) {
                const today = new Date();
                const birthDate = new Date(birthday);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function showNotification(message, type) {
                // Simple notification - you can enhance this
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.textContent = message;
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 16px 24px;
                    background: ${type === 'success' ? '#10B981' : '#EF4444'};
                    color: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 10000;
                    animation: slideIn 0.3s ease;
                `;
                document.body.appendChild(notification);
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        })();
    </script>

</body>
</html>
@endsection

