@extends('base')
@section('content')
<div class="workout-detail-page">
  <link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <h1>Chi Tiết Bài Tập</h1>



  <!-- Video kiểu YouTube -->
  <div class="video-container">
    <div class="video-frame">
      <video controls poster="{{ asset('images/thumbnail.jpg') }}">
        <source src="{{ asset('videos/workout1.mp4') }}" type="video/mp4">
        Trình duyệt của bạn không hỗ trợ phát video.
      </video>
    </div>
  </div>

  <

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
