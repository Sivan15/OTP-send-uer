
<html>
@component('mail::message')
# One-Time Password (OTP)

Please use the following OTP to proceed:

**{{ $otp }}**

This OTP is valid for 5 minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

</html>