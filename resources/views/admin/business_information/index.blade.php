@php
    $route = 'business_information';
@endphp

@extends('admin.layout.table_form')

@section('form')

    <div class="form-container">

        <form class="admin-form" id="business_information-form" action="{{route("business_information_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="group" value="front/information">

            <div class = "form-head">
                <div class="form-parts">
                    <p class="part  part-active" data-part="content">Contacto</p>
                    <p class="part" data-part="logo">Logo</p>
                    <p class="part" data-part="presentation">Presentación</p>
                    <p class="part" data-part="socials">Redes Sociales</p>
                </div>
                <div class="switch-inactive">@include('admin.components.switch-button')</div>
            </div>

        
            <div class = form-body>

                <div class="form-write part-section active" data-part="content">

                    @component('admin.components.locale')

                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Telefono:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[telephone.{{$localization->alias}}]" value="{{isset($business["telephone.$localization->alias"]) ? $business["telephone.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Email:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[email.{{$localization->alias}}]" value="{{isset($business["email.$localization->alias"]) ? $business["email.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
                        
                            
                            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Provincia:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[province.{{$localization->alias}}]" value="{{isset($business["province.$localization->alias"]) ? $business["province.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Población:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[poblation.{{$localization->alias}}]" value="{{isset($business["poblation.$localization->alias"]) ? $business["poblation.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
                        
            
                            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Código postal:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[postalcode.{{$localization->alias}}]" value="{{isset($business["postalcode.$localization->alias"]) ? $business["postalcode.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Dirección:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[adress.{{$localization->alias}}]" value="{{isset($business["adress.$localization->alias"]) ? $business["adress.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Horario:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[schedule.{{$localization->alias}}]" value="{{isset($business["schedule.$localization->alias"]) ? $business["schedule.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent

                </div>

                <div class="form-images part-section" data-part="logo">

                    @component('admin.components.locale')

                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">
    
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Logo</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'single', 
                                            'content' => 'logo', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_logo_preview
                                        ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Logo Negativo</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'single', 
                                            'content' => 'logolight', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_logolight_preview
                                        ])
                                    </div>
                                </div>

                     

                            </div>

                        @endforeach
                
                    @endcomponent

                </div>

                <div  class="form-write part-section" data-part="socials">

                    @component('admin.components.locale')

                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">

                                
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Instagram:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[instagram.{{$localization->alias}}]" value="{{isset($business["instagram.$localization->alias"]) ? $business["instagram.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Facebook:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[facebook.{{$localization->alias}}]" value="{{isset($business["facebook.$localization->alias"]) ? $business["facebook.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Twitter:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[twitter.{{$localization->alias}}]" value="{{isset($business["twitter.$localization->alias"]) ? $business["twitter.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Whatsapp:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[whatsapp.{{$localization->alias}}]" value="{{isset($business["whatsapp.$localization->alias"]) ? $business["whatsapp.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
                            
                            </div>

                        @endforeach
                
                    @endcomponent

                </div>

                <div class="form-write part-section" data-part="presentation">

                    @component('admin.components.locale')

                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-tab="presentation" data-part="{{$localization->alias}}">

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Eslogan:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[slogan.{{$localization->alias}}]" value="{{isset($business["slogan.$localization->alias"]) ? $business["slogan.$localization->alias"] : ''}}"  class="input"  />
                                    </div>
                                </div>
                            

                            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Nuestra Compañia:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <textarea class="ckeditor input-highlight" name="business[ourbusiness.{{$localization->alias}}]">{{isset($business["ourbusiness.$localization->alias"]) ? $business["ourbusiness.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'single', 
                                            'content' => 'ourbusiness', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_our_business_preview
                                        ])
                                    </div>
                                </div>
                            

                            
                                <div class="form-group">
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'single', 
                                            'content' => 'ourfleet', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_our_fleet_preview
                                        ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Nuestra flota:</p></label> 
                                    </div>
                                    <div class="form-input">
                                        <textarea class="ckeditor input-highlight" name="business[ourfleet.{{$localization->alias}}]">{{isset($business["ourfleet.$localization->alias"]) ? $business["ourfleet.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                                
                            </div>

                        @endforeach
                
                    @endcomponent

                </div>

                <div class="form-submit">
                    <div class="form-button" id="save-button">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </div>
                
                    <div class="form-button new-entrance-button" id="eliminate-button" data-url="{{route('faqs_create')}}">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                        </svg> 
                    </div> 
                </div>

            </div>
        </form>

    </div>

@endsection


