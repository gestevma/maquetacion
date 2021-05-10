<div class="languages" data-language = "{{route("faqs")}}">
    @foreach($localizations as $localization)
        <p  class="language-part language {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">{{$localization->name}}</p>
    @endforeach
</div>

{{$slot}}