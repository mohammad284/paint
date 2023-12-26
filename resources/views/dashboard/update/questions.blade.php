@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "de";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@section('content')
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/subBusiness/{{$sub}}">/sub</a></li>
    <li class="breadcrumb-item">/Questions</li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('Questions')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#question"> {{__('add question')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <!-- <th>{{__('name/en')}}</th> -->
                <th>{{__('name/de')}}</th>
                <th>{{__('type')}}</th>
                <th>{{__('input type')}}</th>
                <th>{{__('required')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <!-- <td>{{$question->translate('en')->question}}</td> -->
                    <td>{{$question->translate('de')->question}}</td>
                    <td>@if($question->type == 1)single selection @elseif($question->type == 2 && $question['other_answer'] == null) multi selection @elseif($question['other_answer'] != null) multi selection with input text  @elseif($question->type == 3) input text @endif</td>
                    <td>@if($question->input_type == 1)text @elseif($question->input_type == 2) number @else - @endif</td>
                    <td>@if($question->required == 1)required @else optional @endif</td>
                    <td class="action"> 
                    <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#question-{{$question->id}}"><i data-feather="edit"></i></i></a>
                    @if($question->type == 3)
                    @else
                    <a  title="{{__('edit')}}" href="/admin/answerQuestion/{{$question->id}}">answers-></a>
                    @endif
                    <a  title="{{__('delete')}}" type="button" href="/admin/deleteQues/{{$question->id}}"><i data-feather="trash"></i></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- add business --}}
    <div class="modal fade" id="question" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('add question')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          </div>
          <div class="modal-body">
          <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addquestion/{{$sub_id}}">
          @csrf

          <div class="row mb-12">
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('question/en')}}</label>
                  <input class="form-control mb-4 mb-md-0" name="question_en"  required/>
              </div>
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('question/de')}}</label>
                  <input class="form-control mb-4 mb-md-0" name="question_de"  required/>
              </div>
              <div >
              <br>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select type</label>
              <select class="form-select" name="type" id="exampleFormControlSelect1" required>
                <option value="1" selected>single selection</option>
                <option value="5" selected>single selection with input</option>
                <option value="2">multi selection</option>
                <option value="4">multi selection with input text</option>
                <option value="3">input text</option>
                <option value="6">postal code</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select input type</label>
              <select class="form-select" name="input_type" id="exampleFormControlSelect1">
                <option value="1" selected>text</option>
                <option value="2">number</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select required</label>
              <select class="form-select" name="required" id="exampleFormControlSelect1">
                <option value="1" selected>required</option>
                <option value="0">optional</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select enable</label>
              <select class="form-select" name="enable" id="exampleFormControlSelect1">
                <option value="1" selected>enable</option>
                <option value="0">disable</option>
              </select>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
      </form>
          </div>
            
        </div>
      </div>
    </div>

<!-- update business -->
    @foreach($questions as $question)
    <div class="modal fade" id="question-{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit question')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateQuestion/{{$question->id}}">
            @csrf

            <div class="row mb-12">
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('question/en')}}</label>
                  <input class="form-control mb-4 mb-md-0" value="{{$question->translate('en')->question}}" name="question_en"  required/>
              </div>
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('question/de')}}</label>
                  <input class="form-control mb-4 mb-md-0" value="{{$question->translate('de')->question}}" name="question_de"  required/>
              </div>
              <div >
              <br>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select type</label>
              <select class="form-select" name="type" id="exampleFormControlSelect1" required>
                <option value="1" @if($question->type == 1) selected @endif>single selection</option>
                <option value="5" @if($question->type == 5) selected @endif>single selection with input</option>
                <option value="2"@if($question->type == 2 && $question['other_answer'] != null) selected @endif>multi selection</option>
                <option value="4" @if($question['other_answer'] != null) selected @endif>multi selection with input text</option>
                <option value="3"@if($question->type == 3) selected @endif>input text</option>
                <option value="6"@if($question->type == 6) selected @endif>postal code</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select input type</label>
              <select class="form-select" name="input_type" id="exampleFormControlSelect1">
                <option selected="" disabled="">Select input type</option>
                <option value="1" @if($question->input_type == 1) selected @endif>text</option>
                <option value="2" @if($question->input_type == 2) selected @endif>number</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select required</label>
              <select class="form-select" name="required" id="exampleFormControlSelect1">
                <option selected="" disabled="">Select required</option>
                <option value="1" @if($question->required == 1) selected @endif>required</option>
                <option value="0" @if($question->required == 0) selected @endif>optional</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Select enable</label>
              <select class="form-select" name="enable" id="exampleFormControlSelect1">
                <option value="1" @if($question->enable == 1) selected @endif>enable</option>
                <option value="0" @if($question->enable == 0) selected @endif>disable</option>
              </select>
            </div>
          </div>
            <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
      @endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush