<!DOCTYPE html>

<html >

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel - Razorpay Payment Gateway Integration</title>

</head>
<script>
    function submitform()
    {

        var button = document.getElementsByClassName("razorpay-payment-button")[0];
        button.style.visibility = 'hidden';
        button.click();        
    }
</script>

<body onload="submitform()">

    <div id="app">

        <main class="py-4">

            <div class="container">

                <div class="row">

                    <div class="col-md-6 offset-3 col-md-offset-6">

  

                        @if($message = Session::get('error'))

                            <div class="alert alert-danger alert-dismissible fade in" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <strong>Error!</strong> {{ $message }}

                            </div>

                        @endif

  

                        @if($message = Session::get('success'))

                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <strong>Success!</strong> {{ $message }}

                            </div>

                        @endif

  

                        <div class="card card-default">

                            

                            <div class="card-body text-center">

                                <form action="{{ route('razorpay.payment.store') }}" id="razorpayform" method="POST" >

                                    @csrf

                                    <script src="https://checkout.razorpay.com/v1/checkout.js"

                                            data-key="{{ env('RAZORPAY_KEY') }}"

                                            data-amount={{(int)($order_amount*100)}}

                                            data-buttontext="Pay Now"

                                            data-name="REVERI Jobs"

                                            data-description="Rozerpay"

                                            data-image="{{ asset('/') }}sitesetting_images/thumb/jobs-portal-1629705780-753.png"

                                            data-order_id={{$razorpay_order_id}}

                                            data-prefill.name={{$buyer_name}}

                                            data-prefill.email={{$buyer_email}}

                                            data-theme.color="#ff7529">

                                    </script>

                                </form>

                            </div>

                        </div>

  

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>