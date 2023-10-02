<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="far fa-bell"></i>
        @if ($newCount)
        <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $item)
            <a href="{{ $item->data['url'] }}?notification_id={{ $item->id }}" class="dropdown-item @if ($item->unread()) text-bold @endif">
                <i class="{{ $item->data['icon'] }} mr-2"></i> {{ $item->data['body'] }}
                <span class="float-right text-muted text-sm">{{ $item->created_at->diffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
