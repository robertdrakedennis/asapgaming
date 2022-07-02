<div class="js-cookie-consent cookie-consent alert alert-warning text-center rounded-0 border-left-0 border-right-0 border-bottom-0 w-100 mb-0 alert-dismissible fade show">
    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
        <button class="js-cookie-consent-agree cookie-consent__agree btn btn-sm btn-outline-brand-white" style="margin-left: 0.75rem;-webkit-border-radius: 50vh;-moz-border-radius: 50vh;border-radius: 50vh;" type="button">
        {{ trans('cookieConsent::texts.agree') }}
    </button>
    </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
