@extends('layouts.backend')

@section('title', $data['title'])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Module / Playlist / </span>{{ $data['title'] }} <span class="text-muted">{{ isset($data['playlist']) ? '#'.$data['playlist']['id'] : '' }}</span>
    </h4>

    <a href="{{ route('gallery.playlist.index', ['playlistId' => $data['playlist']['id']]) }}" class="btn btn-sm btn-secondary"><i class="ion ion-ios-arrow-back"></i> Back</a><br><br>

    <!-- Filters -->
    <div class="form-group row">
        <div class="col-sm-2">
            <button class="btn btn-success" data-toggle="modal" data-target="#m_create">
                <i class="fas fa-plus"></i> Create
            </button>
        </div>
    </div>
    <!-- / Filters -->
      
    <!-- Lightbox template -->
    <div class="row drag">
        @foreach ($data['video'] as $item)
        @php
            if ($item['file'] != '' && $item['youtube_id'] == '') {
                $bg = asset('userfile/default/playlist.jpg');
                $type = 'Video';
            } elseif ($item['file'] == '' && $item['youtube_id'] != '') {
                $bg = 'https://i.ytimg.com/vi/'.$item['youtube_id'].'/mqdefault.jpg';
                $type = 'Youtube Video';
            } else {
                $bg = asset('userfile/default/no-image.jpg');
                $type = 'Extension not detected';
            }
        @endphp
        <div class="col-sm-6 col-xl-4" id="{{ $item['id'] }}" style="cursor: move;">
        <div class="card mb-4">
            <div class="w-100">
            <div class="card-img-top d-block ui-rect-60 ui-bg-cover" style="background-image: url({{ $bg }});">
                <div class="d-flex justify-content-between align-items-end ui-rect-content p-3">
                <div class="flex-shrink-1">
                    
                </div>
                <div class="text-big">
                    <div class="badge badge-dark font-weight-bold">{{ $type }}</div>
                </div>
                </div>
            </div>
            </div>
            <div class="card-body">
            <h5 class="mb-3"><a href="#" class="text-body">
                @if ($item['title'] != '')
                    {!! $item['title'] !!}
                @else
                    <i>"No Title"</i>
                @endif
            </a></h5>
            <p class="text-muted mb-3">
                @if ($item['description'] != '')
                    {!! $item['description'] !!}
                @else
                    <i>"No Description"</i>
                @endif
            </p>
            <div class="media">
                <div class="media-body">
                <button type="button" class="btn icon-btn btn-sm btn-primary" data-toggle="modal" data-target="#m_edit{{ $item['id'] }}">
                    <i class="ion ion-md-create text-white"></i>
                </button>
                <a href="javascript:void(0);" class="btn icon-btn btn-sm btn-danger delete" data-toggle="tooltip" data-original-title="click to delete">
                    <i class="ion ion-md-trash text-white"></i>
                    <form action="{{ route('gallery.playlist.destroy.video', ['id' => $item['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')                                            
                    </form>
                </a>
              
                </div>
                <div class="text-muted small">
                    <i class="ion ion-md-time text-primary"></i>
                    <span>{{ $item['created_at']->diffForHumans() }}</span>
                </div>
            </div>
            </div>
        </div>
        </div>
        @endforeach
    </div>

    {{-- pagination --}}
    {{ $data['video']->links() }}
    
</div>

{{-- modal create --}}
<div class="modal fade" id="m_create">
    <div class="modal-dialog">
    <form class="modal-content" action="{{ route('gallery.playlist.store.video', ['playlistId' => $data['playlist']['id']]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
        <h5 class="modal-title">
            Create
            <span class="font-weight-light">Media</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
        <div class="form-group row" style="margin-bottom:0;"> 
       
            <div class="form-group col mb-12">
            <label class="col-form-label">From Youtube </label>
            <br>
            <label class="switcher"> 
                <input type="checkbox" id="switch1" switch="none" name="from_yt" value="1"/>
                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>                
            </label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col mb-12" id="file">
            <label class="form-label">Upload Video</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" placeholder="Enter file...">
            @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col mb-12" id="youtube">
            <label class="form-label">Youtube ID</label>
            <input type="text" class="form-control @error('youtube_id') is-invalid @enderror" name="youtube_id" value="{{ old('youtube_id') }}" placeholder="Enter youtube_id...">
            @error('youtube_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col mb-12">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter title...">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col mb-12">
            <label class="form-label">Description</label>
            <textarea type="text" class="form-control" name="description" placeholder="Enter description...">{{ old('description') }}</textarea>
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
</div>

@foreach ($data['video'] as $modal)
<div class="modal fade" id="m_edit{{ $modal['id'] }}">
    <div class="modal-dialog">
      <form class="modal-content" action="{{ route('gallery.playlist.update.video', ['id' => $modal['id']]) }}" method="POST">
          @csrf
          @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">
            Edit
            <span class="font-weight-light">video</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col mb-12">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title', $modal['title']) }}" placeholder="Enter title...">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col mb-12">
                <label class="form-label">Description</label>
                <textarea type="text" class="form-control" name="description" value="" placeholder="Enter description...">{{ old('description', $modal['description']) }}</textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
</div>
@endforeach
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('asset/temp_backend/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/temp_backend/dropzone/basic.min.css') }}">
@endsection

@section('jsfoot')
<script src="{{ asset('asset/temp_backend/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/temp_backend/dropzone/dropzone.min.js') }}"></script>

<script src="{{ asset('asset/temp_backend/js/ui_modals.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('#youtube').hide();
    $('.switcher').change(function(){
        $('#youtube').toggle('slow');
        $('#youtube').prop('required',true);
        $('#file').toggle('slow');
    });
});
</script>
<script>
    $('.delete').click(function(e)
    {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
        title: 'Are you sure delete this video ?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            $(this).find('form').submit();
        }
        })
    });

  
</script>

@endsection

