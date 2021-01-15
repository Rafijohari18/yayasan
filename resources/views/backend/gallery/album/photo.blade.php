@extends('layouts.backend')

@section('title', $data['title'])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Module / Album / </span>{{ $data['title'] }} <span class="text-muted">{{ isset($data['album']) ? '#'.$data['album']['id'] : '' }}</span>
    </h4>

    <a href="{{ route('gallery.album.index', ['albumId' => $data['album']['id']]) }}" class="btn btn-sm btn-secondary"><i class="ion ion-ios-arrow-back"></i> Back</a><br><br>

    <!-- Filters -->
    <div class="form-group row">
        <div class="col-sm-2">
            <button class="btn btn-success" data-toggle="modal" data-target="#me_create">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>
    <!-- / Filters -->
    <style type="text/css">
        body{
            background-color: #E8E9EC;
        }
        .dropzone {
            border: 2px dashed #0087F7;
        }
    </style>
    <div class="form-group m-form__group row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="dropzone" id="photo">
            <div class="dz-message">
            <h3 class="m-dropzone__msg-title">Lepaskan gambar di sini atau klik untuk mengunggah.</h3>
            <span class="m-dropzone__msg-desc">Unggah hingga 10 gambar</span>
            </div>
        </div>
        </div>
    </div>
      
    <!-- Lightbox template -->
    <div class="row drag">
        @foreach ($data['photo'] as $item)
        <div class="col-sm-6 col-xl-4" id="{{ $item['id'] }}" style="cursor: move;">
        <div class="card mb-4">
            <div class="w-100">
            <div class="card-img-top d-block ui-rect-60 ui-bg-cover" style="background-image: url({{ asset('userfile/album/'.$data['album']['id'].'/'.$item['file']) }});background-size:cover;height:300px;">
                <div class="d-flex justify-content-between align-items-end ui-rect-content p-3">
                <div class="flex-shrink-1">
                    
                </div>
                <div class="text-big">
                    <div class="badge badge-dark font-weight-bold">Photo</div>
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
                    <form action="{{ route('gallery.album.destroy.photo', ['id' => $item['id']]) }}" method="POST">
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
    {{ $data['photo']->links() }}

</div>

{{-- modal create --}}
<div class="modal fade" id="m_create">
    <div class="modal-dialog">
    <form class="modal-content" action="{{ route('gallery.album.store.photo', ['albumId' => $data['album']['id']]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
        <h5 class="modal-title">
            Tambah
            <span class="font-weight-light">Media</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
        <div class="form-row">
            <div class="form-group col mb-12">
            <label class="form-label">Image</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" placeholder="Enter file...">
            @error('file')
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
        <div class="form-row">
            <div class="form-group col mb-12">
            <label class="form-label">Alt</label>
            <input type="text" class="form-control" name="alt" value="{{ old('alt') }}" placeholder="Enter Alt...">
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

@foreach ($data['photo'] as $modal)
<div class="modal fade" id="m_edit{{ $modal['id'] }}">
    <div class="modal-dialog">
      <form class="modal-content" action="{{ route('gallery.album.update.photo', ['id' => $modal['id']]) }}" method="POST">
          @csrf
          @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">
            Edit
            <span class="font-weight-light">Photo</span>
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
          <div class="form-row">
            <div class="form-group col mb-12">
              <label class="form-label">Alt</label>
              <input type="text" class="form-control" name="alt" value="{{ old('alt', $modal['alt']) }}" placeholder="Enter Alt...">
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


<script>
    Dropzone.autoDiscover = false;

    var foto_upload= new Dropzone("#photo",{
    url: "{{ route('gallery.album.store.photo.multi', ['albumId' => $data['album']['id']]) }}",
    maxFilesize: 10,
    method:"POST",
    acceptedFiles:"image/*",
    paramName:"file",
    dictInvalidFileType:"Type file ini tidak dizinkan",
    addRemoveLinks:false,
    
    init : function () {
        this.on('complete', function () {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                location.reload();
            }
        })
    }
    });

    foto_upload.on("sending",function(a,b,c){
        c.append("_token", $('meta[name="csrf-token"]').attr('content'));
        // a.token=Math.random();
        // c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
    });
</script>

<script>
$('.delete').click(function(e)
{
    e.preventDefault();
    var url = $(this).attr('href');
    Swal.fire({
    title: 'Are you sure delete this photo ?',
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
