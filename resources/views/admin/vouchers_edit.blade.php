@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Chỉnh Sửa Mã Giảm Giá</h2>
        <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Mã Code</label>
                    <input type="text" name="code" value="{{ $voucher->code }}" required style="text-transform: uppercase;">
                </div>
                <div class="form-group">
                    <label>Loại giảm giá</label>
                    <select name="discount_type" required>
                        <option value="percent" {{ $voucher->discount_type == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                        <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Số tiền cố định (VND)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Giá trị giảm</label>
                    <input type="number" name="discount_value" value="{{ $voucher->discount_value }}" required>
                </div>
                <div class="form-group">
                    <label>Ngày hết hạn</label>
                    <input type="date" name="expiry_date" value="{{ $voucher->expiry_date ? \Carbon\Carbon::parse($voucher->expiry_date)->format('Y-m-d') : '' }}">
                </div>
                <div class="form-group">
                    <label>Giới hạn lượt dùng</label>
                    <input type="number" name="usage_limit" value="{{ $voucher->usage_limit }}">
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.vouchers') }}" class="btn-danger" style="text-decoration: none; background: #95a5a6;">Hủy</a>
            </div>
        </form>
    </div>
@endsection
