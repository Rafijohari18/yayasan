@extends('layouts.backend')

@section('title', $data['title'])

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">


    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Pengelolaan User /</span> {{ $data['title'] }}
    </h4>
    

    <!-- Filters -->
    <div class="ui-bordered px-4 pt-4 mb-4">
        <div class="form-row align-items-center">
        
       
        <div class="col-md mb-4">
        <form action="" method="GET">
            <label class="form-label">Nama Atau Lainnya</label>
            <input type="text" class="form-control" name="q" value="{{ Request::get('q') }}" placeholder="Search...">
        </div>
        <div class="col-md col-xl-2 mb-4">
            <label class="form-label d-none d-md-block">&nbsp;</label>
            <button type="submit" class="btn btn-secondary btn-block" data-toggle="tooltip" data-original-title="click to search"><i class="fas fa-search"></i></button>
        </form>
        </div>
        </div>
    </div>
    <!-- / Filters -->
    
    <div class="card">
      <div class="card-body d-flex justify-content-between">
          <div class="text-lighter">Total Record : <div class="badge badge-primary">{{ $data['total'] }}</div></div>
        
          <div class="col-md-2"><a href="{{ route('users.create') }}" class="btn btn-info float-right" data-toggle="tooltip" data-original-title="click to add user"><i class="fas fa-plus"></i> Tambah</a></div>
        
      </div>
      <div class="card-datatable table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th width="10px">No</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Roles</th>
              
              <th>Join</th>
             
              <th width="80px">Action</th>
            </tr>
          </thead>
          <tbody>
              @if ($data['total'] == 0)
                  <tr>
                      <td colspan="9" align="center"><i><strong style="color:red;">! No Record From User !</strong></i></td>
                  </tr>
              @endif
              @php
                  $no = $data['users']->firstItem();
              @endphp
              @foreach ($data['users'] as $item)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $item['name'] }}</td>
                  
                  <td><a href="mailto:{{ $item['email'] }}" target="_blank">{{ $item['email'] }}</a></td>
                 
                  <td>
                      <a href="" class="btn btn-xs btn-info">
                      @if($item['level'] == 1)
                        Admin
                      @else
                        Penulis
                      @endif
                        </a>
                  </td>
                 
                 
                  <td>{{ date('d F Y', strtotime($item['created_at'])) }}</td>
                  <td> 
               
                    <a href="{{ route('users.edit', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="klik untuk edit user"><i class="ion ion-md-create"></i></a>         
                    <a onclick="return confirm('Anda Yakin ? ')" href="{{ route('users.destroy', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-danger"  
                    data-toggle="tooltip" data-original-title="klik untuk hapus user">
                    <i class="ion ion-md-trash"></i>
                      
                      </a>
                     
                  
              

                   
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      {{ $data['users']->links() }}
    </div>

</div>
<!-- / Content -->
@endsection


@section('jsbody')
<script>
    $('.dynamic_select').on('change', function () {
        alert('tes');
        var url = $(this).val();
        if (url) {
            window.location = '?r='+url;
        }
        return false;
    });

    $('.dynamic_select2').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = '?s='+url;
        }
        return false;
        //$('form').submit();
    });
</script>
<script>


</script>
@endsection