<table class="table table-bordered">
	<tread>
		<tr>
			<td width="80">Action</td>
			<td>Category Name</td>
			<td width="120">Post Count</td>
		</tr>
	</tread>
	<tbody>
		@foreach ($categories as $category)
			<tr>
			<td>

      {!! Form::open(['method'=> 'DELETE', 'route' => ['backend.categories.destroy', $category->id ]]) !!}

        {{-- @if(check_user_permissions(request(),"", $category->id)) --}}
  				<a href="{{ route('backend.categories.edit', $category->id ) }}" class="btn btn-xs btn-default">
  					<i class="fa fa-edit"></i>
  				</a>
  {{--       @else 
          <a href="#" class="btn btn-xs btn-default disabled">
              <i class="fa fa-edit"></i>
            </a>
        @endif --}}
    
		<button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-xs btn-danger">
					<i class="fa fa-times"></i>
        </button>

      {!! Form::close() !!}

			</td>
			<td>{{ $category->title }}</td>
			<td>{{ $category->posts->count() }}</td>
			</tr>
		@endforeach
	</tbody>
</table>