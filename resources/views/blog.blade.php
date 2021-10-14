<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    @if (app()->currentLocale() == 'ar')
        <style>
            body {
                direction: rtl;
                text-align: right;
            }
        </style>
    @endif

</head>
<body>

    <ul>
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <h1>{{ __('Upload Image') }}</h1>

    @foreach ($blogs as $blog)
        <h2>{{ $blog->trans_title }}</h2>
        <p>{{ $blog->trans_content }}</p>
        <hr>
    @endforeach


</body>
</html>
