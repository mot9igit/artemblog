@if ($paginator->hasPages())
    <div class="posts-pagination">
        @if ($paginator->onFirstPage())
            <span class="p-newer-posts"><i class="fa fa-angle-double-left"></i> сюда </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="p-newer-posts"><i class="fa fa-angle-double-left"></i> сюда </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="p-older-posts">туда <i class="fa fa-angle-double-right"></i></a>
        @else
            <span class="p-newer-posts"> туда <i class="fa fa-angle-double-right"></i></span>
        @endif
    </div>
@endif
