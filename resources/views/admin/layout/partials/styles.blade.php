@if($agent->isDesktop())
    <link href="{{mix('css/admin/desktop/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('css/admin/mobile/app.css')}}" rel="stylesheet">
@endif