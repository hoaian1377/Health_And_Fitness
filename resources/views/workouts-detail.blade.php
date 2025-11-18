@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="workout-detail-page">
    <h1>Chi Tiết Bài Tập</h1>

    @if(!$exercise)
    <p>Không tìm thấy bài tập.</p>
    @else
        <div class="video-container">
            <div class="video-frame">
                <video controls poster="{{ $exercise->name_workout}}">
                    <source src="{{ $exercise->video_urls }}" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ phát video.
                </video>
            </div>
        </div>
    @endif


    <!-- Modal -->
    <div id="mealModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="mealTitle"></h3>
            <p id="mealDesc"></p>
        </div>
    </div>
</div>

<script src="{{ asset('js/workout.js') }}"></script>
@endsection
