@extends('layouts.master')
@section('title', 'Terms of Service')
@section('body-background', 'bg-brand-black')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="jumbotron bg-transparent text-center">
                    <h1 class="text-white">Terms of Service</h1>
                    <h5 class="text-white">This applies globally to any service or product we provide.</h5>
                    <img src="{{ asset('/assets/media/logo/color.svg') }}" class="d-block mx-auto" style="height: auto; width: 15rem;">
                </div>
            </div>
            <div class="col-12 text-light my-5">
                <h4>General</h4>
                <p>
                    {{ config('app.name') }} (“<a href="{{ route('home') }}">{{ config('app.url') }}</a>”) owns and operates this Website.  This document governs your relationship with <a href="{{ route('home') }}">{{ config('app.url') }}</a> .
                    Access to, and use of this Website, products and services available through this Website (collectively, the "Services") are subject to the following terms, conditions and notices (the "Terms of Service"). By using the Services, you are agreeing to all of the Terms of Service, as may be updated by us from time to time. You should check this page regularly to take notice of any changes we may have made to the Terms of Service.
                    (a)Access to this Website is permitted on a temporary basis, and we reserve the right to withdraw or amend the Services without notice. We will not be liable if for any reason this Website is unavailable at any time or for any period. From time to time, we may restrict access to some parts or all of this Website.
                </p>
                <h4> Prohibitions</h4>
                <p>
                    (a)You must not misuse this Website. You will not: commit or encourage a criminal offense; transmit or distribute a virus, trojan, worm, logic bomb or any other material which is malicious, technologically harmful, in breach of confidence or in any way offensive or obscene; hack into any aspect of the Service; corrupt data; cause annoyance to other users; infringe upon the rights of any other person's proprietary rights; send any unsolicited advertising or promotional material, commonly referred to as "spam"; or attempt to affect the performance or functionality of any computer facilities of or accessed through this Website. Breaching this provision would constitute a criminal offense and <a href="{{ route('home') }}">{{ config('app.url') }}</a> will report any such breach to the relevant law enforcement authorities and disclose your identity to them.
                    (b) We will not be liable for any loss or damage caused by a distributed denial-of-service attack, viruses or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of this Website or to your downloading of any material posted on it, or on any website linked to it.
                    Intellectual Property, Software and Content
                    The intellectual property rights in all software and content (including photographic images) made available to you on or through this Website remains the property of <a href="{{ route('home') }}">{{ config('app.url') }}</a> or its licensors and are protected by copyright laws and treaties around the world. All such rights are reserved by <a href="{{ route('home') }}">{{ config('app.url') }}</a> and its licensors. You may store the content supplied solely for your own personal use. You are not permitted to publish, manipulate, distribute or otherwise reproduce, in any format, any of the content or copies of the content supplied to you or which appears on this Website nor may you use any such content in connection with any business or commercial enterprise.
                </p>
                <h4>Terms of Sale</h4>
                <p>
                    By placing an order, or giving a donation, you are offering to purchase a product on and subject to the following terms and conditions. All orders are subject to availability and confirmation of the order price.
                    (a) In order to contract with <a href="{{ route('home') }}">{{ config('app.url') }}</a> you must be over 18 years of age and possess a valid Paypal account. When placing an order you undertake that all details you provide to us are true and accurate, that you are an authorized user of the Paypal used to place your order and that there are sufficient funds to cover the cost of the Credits. All prices advertised are subject to such changes.
                    (b) Payment
                    To purchase something extra or to set up your donations, go to <a href="{{ route('home') }}">{{ config('app.url') }}</a> and follow the instructions provided to you on the page.
                    (c) Expecting Rewards
                    If your items purchased are not automatically added onto your account, please go to the support section to open up a ticket. We will get to you as soon as we can and help you receive your item.
                    (d) Paypal
                    As the customer, it is your responsibility to put a note in your paypal purchase/donation. This will make things easier in noting if your purchase was you, and true.
                </p>
                <h4> Indemnity</h4>
                <p>
                    You agree to indemnify, defend and hold harmless <a href="{{ route('home') }}">{{ config('app.url') }}</a>, from any and all third party claims, liability, damages and/or costs (including, but not limited to, legal fees) arising from your use this Website or your breach of the Terms of Service.
                </p>
                <h4>Variation</h4>
                <p>
                    <a href="{{ route('home') }}">{{ config('app.url') }}</a>  shall have the right in its absolute discretion at any time and without notice to amend, remove or vary the Services and/or any page of this Website.
                </p>
                <h4>Invalidity</h4>
                <p>
                    If any part of the Terms of Service is unenforceable (including any provision in which we exclude our liability to you) the enforceability of any other part of the Terms of Service will not be affected all other clauses remaining in full force and effect. So far as possible where any clause/sub-clause or part of a clause/sub-clause can be severed to render the remaining part valid, the clause shall be interpreted accordingly. Alternatively, you agree that the clause shall be rectified and interpreted in such a way that closely resembles the original meaning of the clause /sub-clause as is permitted by law.
                </p>
                <h4>Complaints</h4>
                <p>
                    We operate a complaints handling procedure which we will use to try to resolve disputes when they first arise, please let us know if you have any complaints or comments.
                </p>
                <h4>Refunds</h4>
                <p>
                    All payments are final and are not refundable. Please be sure you purchase the correct item and enter the correct account information before you finalize your payment.
                </p>
                <h4>Waiver</h4>
                <p>
                    If you breach these conditions and we take no action, we will still be entitled to use our rights and remedies in any other situation where you breach these conditions.
                </p>
                <h4>Entire Agreement</h4>
                <p>
                    The above Terms of Service constitute the entire agreement of the parties and supersede any and all preceding and contemporaneous agreements between you and <a href="{{ route('home') }}">{{ config('app.url') }}</a>.
                </p>
                <p>
                    BY USING THIS SERVICE, YOU REPRESENT THAT YOU HAVE READ AND AGREE TO THE TERMS OF SERVICE, THAT YOU AGREE TO ABIDE BY OUR IN-GAME POLICIES, AND THAT YOU ACKNOWLEDGE AND UNDERSTAND OUR PRIVACY POLICY.
                </p>
            </div>
        </div>
    </div>
@endsection
