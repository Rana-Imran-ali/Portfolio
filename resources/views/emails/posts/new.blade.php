<x-mail::message>
# New Post: {{ $postTitle }}

A new update has been posted on Imran Developer's portfolio.

<x-mail::button :url="$postUrl">
Read More
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
