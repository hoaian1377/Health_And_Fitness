@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Mã Giảm Giá Mới</h2>
        <form action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Mã Code</label>
                    <input type="text" name="code" required placeholder="Ví dụ: SALE2025" style="text-transform: uppercase;">
                </div>
                <div class="form-group">
                    <label>Loại giảm giá</label>
                    <select name="discount_type" required>
                        <option value="percent">Phần trăm (%)</option>
                        <option value="fixed">Số tiền cố định (VND)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Giá trị giảm</label>
                    <input type="number" name="discount_value" required placeholder="Ví dụ: 20 hoặc 50000">
                </div>
                <div class="form-group">
                    <label>Ngày hết hạn</label>
                    <input type="date" name="expiry_date">
                </div>
                <div class="form-group">
                    <label>Giới hạn lượt dùng</label>
                    <input type="number" name="usage_limit" placeholder="Để trống nếu không giới hạn">
                </div>
            </div>
            <button type="submit" class="btn-primary" style="margin-top: 15px;">Thêm Voucher</button>
        </form>
    </div>

    <div class="card">
        <h2>Danh Sách Mã Giảm Giá</h2>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Hết hạn</th>
                    <th>Đã dùng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                <tr>
                    <td><strong>{{ $voucher->code }}</strong></td>
                    <td>{{ $voucher->discount_type == 'percent' ? 'Phần trăm' : 'Số tiền' }}</td>
                    <td>
                        {{ $voucher->discount_type == 'percent' ? $voucher->discount_value . '%' : number_format($voucher->discount_value) . ' đ' }}
                    </td>
                    <td>
                        @if($voucher->expiry_date)
                            {{ \Carbon\Carbon::parse($voucher->expiry_date)->format('d/m/Y') }}
                            @if(\Carbon\Carbon::now()->gt($voucher->expiry_date))
                                <span style="color: red; font-size: 12px;">(Hết hạn)</span>
                            @endif
                        @else
                            Vô thời hạn
                        @endif
                    </td>
                    <td>{{ $voucher->used_count }} / {{ $voucher->usage_limit ?? '∞' }}</td>
                    <td>
                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
