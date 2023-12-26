@extends('dashboard.layout.master')

@section('content')
<div class="row inbox-wrapper">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                        <div class="d-flex align-items-end mb-2 mb-md-0">
                            <i data-feather="inbox" class="text-muted me-2"></i>
                            <h4 class="me-1">{{__('support emails')}}</h4>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                    </div>

                    <div class="email-list">
                    @foreach($questions as $question)
                        <!-- email list item -->
                        <div class="email-list-item email-list-item--unread">
                            <div class="email-list-actions">
                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#question-{{$question->id}}" class="email-list-detail">
                            <div class="content">
                                <span class="from">{{$question['user']->first_name}}</span>
                                <p class="msg">{{$question->question}}</p>
                            </div>
                            <span class="date">
                            {{$question->created_at->format('j F, Y')}}
                            </span>
                            </a>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@foreach($questions as $question)
    <div class="modal fade" id="question-{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('support')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/reply/{{$question->id}}">
                @csrf
                    <div class="col-md-12">
                        <label for="exampleInputNumber1" class="form-label">{{__('question')}}</label>
                        <textarea id="maxlength-textarea" class="form-control"  rows="6" >{{$question->question}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('reply')}}:</label>
                        <textarea id="maxlength-textarea" class="form-control" name="reply" id="defaultconfig-4"  rows="6" >{{$question->reply}}</textarea>
                    </div>
                    <div >
                        <br>
                    </div>
                    @if($question->reply == null)
                <button type="submit" class="btn btn-primary me-2">{{__('reply')}}</button>@endif
            </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
@endsection