<style>
    .innerbannersec .overshadowbox {
        height: auto !important;
    }

    .contactformsec .container {
        max-width: 800px;
    }

    .contactformsec .input-group-text {
        background: none;
        border: none;
        border-radius: 0;
        border-bottom: 1px solid #6c6c6c;
    }
</style>

{{-- @if (!session()->has('status'))
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif --}}

<!-- contact form sec start -->
<section class="contactformsec">

    <div class="container">

        <div class="contactformsec_inner">

            <div class="row">
                {{-- <div class="col-md-3"></div> --}}
                <div class="col-md-12">

                    <div class="contact_form">
                        <h2 class="text-center">Thank You</h2>

                        @if (session('status') == 'success')
                            <p class="text-center" style="color: green;">Transaction Successfully Completed</p>
                        @else
                            <p class="text-center" style="color: red;">Transaction Failed</p>
                        @endif

                        {{-- <p class="text-center">Your Reference Number: <strong>{{ session('message') }}</strong></p> --}}
                    </div>

                </div>



            </div>

        </div>

    </div>

</section>
