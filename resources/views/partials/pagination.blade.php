@if ($pagination->lastPage > 1)
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  	@if ($pagination->currentPage <= 1)
	    <li class="page-item disabled">
	      <a class="page-link" href="#" tabindex="-1">{{ trans('lang.first') }}</a>
	    </li>
    @else
    	<li class="page-item">
    		<a class="page-link" href="{{ $pagination->startUrl }}">
    			{{ trans('lang.first') }}
    		</a>
    	</li>
    @endif
    @if (($pagination->currentPage-1) < $pagination->start)
    	<li class="page-item disabled">
	      <a class="page-link" href="#" tabindex="-1">&laquo; {{ trans('lang.previous') }}</a>
	    </li>
    @else
	    <li class="page-item">
	    	<a class="page-link" href="{{ $pagination->previousUrl }}">
	    		&laquo; {{ trans('lang.previous') }}
	    	</a>
	    </li>
    @endif
    @for($i = $pagination->start; $i<=$pagination->end;$i++)
		<li class="page-item {{$pagination->pages[$i]->class}}">
			<a href="{{ $pagination->pages[$i]->link }}" class="page-link">
				{{ $pagination->pages[$i]->html }}
				@if($pagination->pages[$i]->class == "active")
					<span class="sr-only">(current)</span>
				@endif
			</a>
		</li>
	@endfor
    @if (($pagination->currentPage+1) > $pagination->end)
    	<li class="page-item disabled">
	      <a class="page-link" href="#"> {{ trans('lang.next') }} &raquo; </a>
	    </li>
    @else
	    <li class="page-item">
	    	<a class="page-link" href="{{ $pagination->nextsUrl }}">
				{{ trans('lang.next') }} &raquo; 
	    	</a>
	    </li>
    @endif
    @if ($pagination->currentPage >= $pagination->lastPage)
	    <li class="page-item disabled">
	      <a class="page-link" href="#" tabindex="-1">{{ trans('lang.first') }}</a>
	    </li>
    @else
    	<li class="page-item">
    		<a class="page-link" href="{{ $pagination->lastUrl }}">
    			{{ trans('lang.last') }}
    		</a>
    	</li>
    @endif
  </ul>
</nav>
@endif