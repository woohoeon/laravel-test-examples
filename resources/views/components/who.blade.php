@if (Auth::guard('admin')->check())
    <p class="text-success">
        You are Logged In as a <strong>ADMIN</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>ADMIN</strong>
    </p>
@endif

@if (Auth::guard('agent')->check())
    <p class="text-success">
        You are Logged In as a <strong>AGENT</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>AGENT</strong>
    </p>
@endif

@if (Auth::guard('company')->check())
    <p class="text-success">
        You are Logged In as a <strong>COMPANY</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>COMPANY</strong>
    </p>
@endif