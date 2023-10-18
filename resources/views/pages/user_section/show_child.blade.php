<li>
    <div  class="treeview__level" data-level="{{ levelArray($level) }}" style='--img:url("{{ $node->thumb() }}"); {{ $node->is_dummy ? "    border: 1px dashed #e3caf9 !important;
        background: #ffe8e8;" : "" }} '>
        <span class="level-title">{{ ucwords($node->name) }} <small>({{ getRoleDisplay($node->role) }})</small>
        </span>
        @if(auth()->user()->role == 'admin')
        <a href="{{ route('login_as_user', [$node->id]) }}"> <button class="btn btn-outline-success"
                style="margin-left:10px; padding :2px 6px; font-size: 13px;"><i data-feather="log-in"></i></button></a></b> </button></a>
                <a href="{{ route('user.edit', [$node->id]) }}"> <button class="btn btn-outline-primary"
                    style="margin-left:5px; padding :2px 6px; "><i data-feather="edit-3"></i></button></a>
                @endif
       

    </div>
    @if ($node->descendants->isNotEmpty())
    @php
    $level++;
    @endphp
    <ul>
        @foreach ($node->descendants as $descendant)
        @include('pages.user_section.show_child', ['node' => $descendant, 'level' => $level])
        @endforeach
    </ul>

    @endif

</li>