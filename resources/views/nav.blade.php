@if(!empty($nav))
<div class="navigation">
    @if($nav['previousPage'] !== false)
    <a  href="{{$nav['path']}}?page=0&{{$filterString}}">First</a>&nbsp
    @endif
    @if($nav['previousPage'] !== false)
    <a  href="{{$nav['path']}}?page={{$nav['previousPage']}}&{{$filterString}}">Previous</a>&nbsp
    @endif
    @if($nav['nextPage'])
    <a  href="{{$nav['path']}}?page={{$nav['nextPage']}}&{{$filterString}}">Next</a>&nbsp
    @endif
    @if($nav['page'] != $nav['lastPage'])
    <a  href="{{$nav['path']}}?page={{$nav['lastPage']}}&{{$filterString}}">Last</a>
    @endif
</div>
@endif
