@if($agent->isDesktop())
    <link href="{{mix('css/front/desktop/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('css/front/desktop/app.css')}}" rel="stylesheet">
@endif
