@if($agent->isDesktop())
    <link href="{{mix('css/front/desktop/login/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('css/front/mobile/login/app.css')}}" rel="stylesheet">
@endif
