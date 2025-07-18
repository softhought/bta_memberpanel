<style>
    .contactformsec {
        padding: 60px 0;
        background: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .contactformsec .container {
        max-width: 600px;
        background: #fff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 40px;
        border-radius: 12px;
        text-align: center;
    }

    .contactformsec h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .contactformsec p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .contactformsec .success {
        color: #28a745;
        font-weight: 600;
    }

    .contactformsec .error {
        color: #dc3545;
        font-weight: 600;
    }

    .contactformsec .thankyou-icon {
        font-size: 60px;
        margin-bottom: 20px;
    }

    .thankyou-icon.success {
        color: #28a745;
    }

    .thankyou-icon.error {
        color: #dc3545;
    }
</style>

{{-- Redirect to home if no status --}}
@if (!session()->has('status'))
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif

<!-- Contact form section start -->
<section class="contactformsec">
    <div class="container">

        <div class="thankyou-icon {{ session('status') == 'success' ? 'success' : 'error' }}">
            <i class="fas {{ session('status') == 'success' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
        </div>

        <h2>{{ session('status') == 'success' ? 'Thank You' : 'Opps' }}</h2>

        @if (session('status') == 'success')
            <p class="success">Transaction Successfully Completed</p>
        @else
            <p class="error">Transaction Failed</p>
        @endif

        {{-- Optional reference number --}}
        <p>Your Reference Number: <strong>{{ session('message') }}</strong></p>

    </div>
</section>

<!-- FontAwesome CDN (if not already included) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
