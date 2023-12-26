@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('rooms')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('name')}}</th>
                <th>{{__('old color')}}</th>
                <th>{{__('new color')}}</th>
                <th>{{__('damage')}}</th>
                <th>{{__('area/height')}}</th>
                <th>{{__('old_status')}}</th>
                <th>{{__('new_status')}}</th>
                <th>{{__('glossy')}}</th>     
                <th>{{__('old_status_paint')}}</th>
                <th>{{__('old_status_paper')}}</th>
                <th>{{__('old_status_paste')}}</th>
                <th>{{__('old_status_plaster')}}</th>
                <th>{{__('new_status_paint')}}</th>
                <th>{{__('new_status_paper')}}</th>
                <th>{{__('new_status_paste')}}</th>
                <th>{{__('new_status_plaster')}}</th>
                <th>{{__('peeling_wallpaper')}}</th>
                <th>{{__('num_paste')}}</th>
                <th>{{__('number_holes')}}</th>
                <th>{{__('number_incisions')}}</th>
                <th>{{__('paper type')}}</th>
                <th>{{__('corner_style')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($room['walls'] as $wall)
                    <tr>
                        <td>{{__('wall')}}</td>
                        @if($wall['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else<td><span class="badge bg-success" style="background-color:#{{$wall['oldcolor']->hex}}; margin-right:60%;">{{$wall['oldcolor']->name}}</td>                        
                        @endif
                        @if($wall['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else
                        <td><span class="badge bg-success" style="background-color:#{{$wall['newcolor']->hex}}; margin-right:60%;">{{$wall['newcolor']->name}}</td>
                        @endif
                        <td>{{$wall->damage}}%</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        @if($wall->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->old_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->old_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->old_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->new_status_paint)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->new_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->new_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->new_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($wall->peeling_wallpaper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>{{$wall->num_paste}}</td>
                        <td>{{$wall->number_holes}}</td>
                        <td>{{$wall->number_incisions}}</td>
                        <td>{{$wall->paper_type}}</td>
                        @if($wall->corner_style)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                    </tr>
                @endforeach
                @foreach($room['roofs'] as $roof)
                    <tr>
                        <td>{{__('roof')}}</td>
                        @if($roof['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else
                        <td><span class="badge bg-success" style="background-color:#{{$roof['oldcolor']->hex}}; margin-right:60%;">{{$roof['oldcolor']->name}}</td>
                        @endif
                        @if($roof['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else
                        <td><span class="badge bg-success" style="background-color:#{{$roof['newcolor']->hex}}; margin-right:60%;">{{$roof['newcolor']->name}}</td>
                        @endif
                        <td>{{$roof->damage}}%</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        @if($roof->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->old_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->old_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->old_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->new_status_paint)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->new_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->new_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->new_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($roof->peeling_wallpaper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>{{$roof->num_paste}}</td>

                        <td>{{$roof->number_holes}}</td>
                        <td>{{$roof->number_incisions}}</td>
                        <td>{{$roof->paper_type}}</td>
                        @if($roof->corner_style)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif

                    </tr>
                @endforeach
                @foreach($room['windows'] as $window)
                    <tr>
                        <td>{{__('window')}}</td>
                        @if($window['old_color'] == null)
                        <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">##</td>@endif
                        @if($window['old_color'] != null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">{{$window->old_color}}</td>@endif
                        @if($window['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">{{$window['newcolor']->color}}</td>@endif
                        @if($window['newcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$window['newcolor']->hex}}; margin-right:60%;">{{$window['newcolor']->name}}</td>@endif
                        <td>{{$window->damage}}%</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        @if($window->glossy == 0) <td>{{__('no glossy')}} </td> @endif
                        @if($window->glossy == 1) <td> {{__('window')}}</td> @endif
                        @if($window->glossy == 2) <td>{{__('frame')}} </td> @endif
                        @if($window->glossy == 3) <td> {{__('both')}} </td> @endif
                        @if($window->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($window->old_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($window->new_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($window->new_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($window->peeling_wallpaper == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                @foreach($room['doors'] as $door)
                    <tr>
                        <td>{{__('door')}}</td>
                        @if($door['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($door['oldcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$door['oldcolor']->hex}}; margin-right:60%;">{{$door['oldcolor']->name}}</td>
                        @endif
                        @if($door['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($door['newcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$door['newcolor']->hex}}; margin-right:60%;">{{$door['newcolor']->name}}</td>
                        @endif
                        <td>{{$door->damage}}%</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        @if($door->glossy == 0) <td>{{__('no glossy')}} </td> @endif
                        @if($door->glossy == 1) <td> {{__('door')}}</td> @endif
                        @if($door->glossy == 2) <td>{{__('frame')}} </td> @endif
                        @if($door->glossy == 3) <td> {{__('both')}} </td> @endif
                        @if($door->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($door->old_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($door->new_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($door->new_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>#####</td>
                        @if($door->peeling_wallpaper == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                @endforeach
                @foreach($room['edges'] as $edge)
                    <tr>
                        <td>{{__('edge')}}</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>{{$edge->damage}}%</td>
                        <td>{{$edge->area}}</td>
                        <td>{{$edge->old_status}}</td>
                        <td>{{$edge->new_status}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                @foreach($room['corridors'] as $corridor)
                    <tr>
                        <td>{{__('corridor')}}</td>
                        @if($corridor['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else
                        <td><span class="badge bg-success" style="background-color:#{{$corridor['oldcolor']->hex}}; margin-right:60%;">{{$corridor['oldcolor']->name}}</td>
                        @endif
                        @if($corridor['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @else
                        <td><span class="badge bg-success" style="background-color:#{{$corridor['newcolor']->hex}}; margin-right:60%;">{{$corridor['newcolor']->name}}</td>
                        @endif
                        <td>{{$corridor->damage}}%</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        <td>#####</td>
                        @if($corridor->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->old_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->old_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->old_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->new_status_paint)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->new_status_paper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->new_status_plaster)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->new_status_paste)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        @if($corridor->peeling_wallpaper)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif
                        <td>{{$corridor->num_paste}}</td>
                        <td>{{$corridor->number_holes}}</td>
                        <td>{{$corridor->number_incisions}}</td>
                        <td>{{$corridor->paper_type}}</td>
                        @if($corridor->corner_style)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                        @endif

                    </tr>
                @endforeach
                @foreach($room['stairs'] as $stair)
                    <tr>
                        <td>{{__('stair')}}</td>
                        @if($stair['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($stair['oldcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$stair['oldcolor']->hex}}; margin-right:60%;">{{$stair['oldcolor']->name}}</td>
                        @endif
                        @if($stair['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($stair['newcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$stair['newcolor']->hex}}; margin-right:60%;">{{$stair['newcolor']->name}}</td>
                        @endif
                        <td>{{$stair->damage}}%</td>
                        <td>{{$stair->height}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@foreach($room['walls'] as $wall)
    <div class="modal fade" id="wall-{{$wall->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit wall')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdmin/{{$wall->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('old status')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="old_status" value="{{$wall->old_status}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new status')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="new_stauts" value="{{$wall->new_stauts}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('damage')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="damage" value="{{$wall->damage}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('old color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$wall->old_color}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$wall->new_color}}" required/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
@endforeach
@foreach($room['windows'] as $window)
    <div class="modal fade" id="window-{{$window->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit window')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdmin/{{$window->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('old status')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="old_status" value="{{$window->old_status}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new status')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="new_status" value="{{$window->new_status}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('old color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$window->old_color}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$window->new_color}}" required/>
                </div>
                <div >
                <br>
              </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
        </form>
            </div>
              
          </div>
        </div>
    </div>
@endforeach
@foreach($room['roofs'] as $roof)
    <div class="modal fade" id="roof-{{$roof->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit roof')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdmin/{{$roof->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('old status')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="old_status" value="{{$roof->old_status}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new status')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="new_stauts" value="{{$roof->new_stauts}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('old color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$roof->old_color}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$roof->new_color}}" required/>
                </div>
                <div >
                <br>
              </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
        </form>
            </div>
              
          </div>
        </div>
    </div>
@endforeach
@foreach($room['doors'] as $door)
    <div class="modal fade" id="door-{{$door->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit door')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdmin/{{$door->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('old status')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="old_status" value="{{$door->old_status}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new status')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="new_status" value="{{$door->new_status}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('old color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$door->old_color}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('new color')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$door->new_color}}" required/>
                </div>
                <div >
                <br>
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