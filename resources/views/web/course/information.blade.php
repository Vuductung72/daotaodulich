@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Danh sách khóa học')
@section('content')
    <section id="page-certificate-information">
        <div class="container">
            <h2 class="text-center text-primary title">Thông tin xác nhận thi ngay</h2>
            <form action="{{route('w.certificate.store', $course)}}" method="POST" id="certificate-information">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="content">Thông tin xác nhận:</label>
                    <textarea  type="text" id="content" class="form-control tinymce" name="content" >{!! old('content') !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Gửi</button>
            </form>
        </div>
    </section>
@endsection

@prepend('scripts')

<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')
@endprepend
