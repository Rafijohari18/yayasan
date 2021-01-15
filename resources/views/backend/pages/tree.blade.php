@foreach ($childs as $child)    
<tr>
    <td><i class="ion ion-logo-slack"></i></td>
    <td> ---- <i>{!! $child->getFieldLang()->title !!}</i></td>
    
    <td>
       <strong>
        @if ($child->userUpdated['name'] == null)
        {{ $child->userCreated['name'] }}
        @else
            {{ $child->userUpdated['name'] }}
        @endif
        </strong><br>
       <code>{{ $child['updated_at']->format('d F Y H:i') }} | {{ $child['updated_at']->diffForHumans() }}</code>
   </td>
   <td>
    @php
    $min = $child->where('parent', $child['parent'])->min('position');
    $max = $child->where('parent', $child['parent'])->max('position');
    @endphp
    @if ($min != $child['position'])
    <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to up position">
        <i class="ion ion-md-arrow-round-up"></i>
        <form action="{{ route('pages.position', ['id' => $child['id'], 'position' => ($child['position'] - 1), 'parent' => $child['parent']]) }}" method="POST">
            @csrf
            @method('PUT')                                            
        </form>
    </a>
    @else
    <button type="button" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to up position" disabled><i class="ion ion-md-arrow-round-up"></i></button>
    @endif
    @if ($max != $child['position'])
    <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to down position">
        <i class="ion ion-md-arrow-round-down"></i>
        <form action="{{ route('pages.position', ['id' => $child['id'], 'position' => ($child['position'] + 1), 'parent' => $child['parent']]) }}" method="POST">
            @csrf
            @method('PUT')                                            
        </form>
    </a>
    @else
    <button type="button" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to down position" disabled><i class="ion ion-md-arrow-round-down"></i></button>
    @endif
   </td>
   <td>
       
        <a href="{{ route('pages.create', 'parent='.$child['id']) }}" class="btn icon-btn btn-sm btn-success" data-toggle="tooltip" data-original-title="click to add child s">
            <i class="fas fa-plus"></i>
        </a>
        <a href="{{ route('pages.media', ['pageId' => $child['id']]) }}" class="btn icon-btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="click to view media">
            <i class="fas fa-play-circle"></i>
        </a>

     
      
        <a href="{{ route('pages.edit', ['id' => $child['id']]) }}" class="btn icon-btn btn-sm btn-info" data-toggle="tooltip" data-original-title="click to edit page">
            <i class="ion ion-md-create"></i>
        </a>
       
        
        <a href="{{ route('pages.destroy', ['id' => $child['id']]) }}" class="btn icon-btn btn-sm btn-danger delete" onclick="return confirm('Anda Yakin ?')" data-toggle="tooltip" data-original-title="click to delete pages"><i class="ion ion-md-trash"></i>
                                    
        </a>
       
    </td>
</tr>
@if (count($child->childs))
    @include('backend.pages.tree', ['childs' => $child->childs])
@endif
@endforeach