@component('mail::message')
# Order Shipped

Your order has been shipped!

@component('mail::button', ['url' => 'https://cloud-services-portal.dev'])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
