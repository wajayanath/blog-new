<table class="table table-bordered">
	<tread>
		<tr>
			<td width="80">Action</td>
			<td>Title</td>
			<td width="120">Author</td>
			<td width="120">Category</td>
			<td width="170">Date</td>
		</tr>
	</tread>
	<tbody>
		@foreach ($posts as $post)
			<tr>
			<td>

      {!! Form::open(['style' => 'display:inline-block;' ,'method'=> 'PUT', 'route' => ['backend.blog.restore', $post->id ]]) !!}
			 
       {{--  @if(check_user_permissions(request(),"", $post->id)) --}}
  				<button title="Restore" type="submit" class="btn btn-xs btn-default"}}">
  					<i class="fa fa-refresh"></i>
  				</button>
  	{!! Form::close() !!}			
     {{--    @else  --}}
     {{--      <a href="#" class="btn btn-xs btn-default disabled"> 
              <i class="fa fa-edit"></i>
            </a> --}}
     {{--    @endif --}}
    {!! Form::open(['style' => 'display:inline-block;' ,'method'=> 'DELETE', 'route' => ['backend.blog.force-destroy', $post->id ]]) !!}
				<button title="Delete Permenent" onclick="retun confirm('You are about to delete a post permanently. Are you sure?');" type="submit" class="btn btn-xs btn-danger">  
					<i class="fa fa-times"></i>
        </button>

      {!! Form::close() !!}

			</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->author->name }}</td>
			<td>{{ $post->category->title }}</td>
			<td>
				<abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
				
			</td>
			</tr>
		@endforeach
	</tbody>
</table>