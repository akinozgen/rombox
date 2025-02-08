<x-mail::message>
# 🎉 Congratulations!

You've reached a significant milestone in your counter journey!

<x-mail::panel>
## Milestone Details
- **Counter Value:** {{ $count }}
- **Achieved at:** {{ $timestamp }}
</x-mail::panel>

<x-mail::table>
| Metric | Value |
|--------|--------|
| Target | 10 |
| Achieved | {{ $count }} |
| Success Rate | 100% |
</x-mail::table>

<x-mail::button :url="config('app.url')" color="success">
View Counter Dashboard
</x-mail::button>

## What's Next?
Keep pushing forward! Every click brings you closer to your next milestone.

Thanks,<br>
{{ config('app.name') }}

<x-mail::subcopy>
This is an automated notification from your Counter Application.
If you didn't expect this, please ignore this email.
@if($marketing)
<br><br>
To unsubscribe from marketing emails, <a href="{{ route('unsubscribe', $unsubscribeToken) }}">click here</a>
@endif
</x-mail::subcopy>
</x-mail::message>
