<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>SkillSwap - Verify Email</title>
</head>

<body style="background: #f8f9fa;">

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6 col-lg-4">
            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Verify your email address</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <i class="fa fa-envelope" style="font-size: 3rem; color: #14a800;"></i>
                        <h4 class="mt-3">Check Your Email</h4>
                        <p class="text-muted">
                            We've sent a 4-digit verification code to<br>
                            <strong>{{ auth()->user()->email }}</strong>
                        </p>
                    </div>

                    <form method="POST" action="{{ route('otp.verify') }}" id="otpForm">
                        @csrf
                        
                        <div class="form-group text-center">
                            <label for="otp" class="form-label">Enter 4-digit OTP</label>
                            <div class="otp-input-container d-flex justify-content-center gap-2 mb-3">
                                <input type="text" class="form-control otp-input" maxlength="1" data-index="0" required>
                                <input type="text" class="form-control otp-input" maxlength="1" data-index="1" required>
                                <input type="text" class="form-control otp-input" maxlength="1" data-index="2" required>
                                <input type="text" class="form-control otp-input" maxlength="1" data-index="3" required>
                            </div>
                            <input type="hidden" name="otp" id="otpField">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block" id="verifyBtn" disabled>
                                <i class="fa fa-check mr-2"></i>Verify Email
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-2">Didn't receive the code?</p>
                        <form method="POST" action="{{ route('otp.send') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link text-primary">
                                <i class="fa fa-refresh mr-1"></i>Resend OTP
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    <a href="{{ route('user.dashboard') }}" class="text-primary">Skip for now</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpField = document.getElementById('otpField');
    const verifyBtn = document.getElementById('verifyBtn');

    // Focus first input on load
    otpInputs[0].focus();

    // Handle input events
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Only allow numbers
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }

            // Move to next input if current is filled
            if (value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            // Update hidden field
            updateOtpField();
        });

        input.addEventListener('keydown', function(e) {
            // Handle backspace
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text');
            const numbers = pastedData.replace(/\D/g, '').slice(0, 4);
            
            if (numbers.length === 4) {
                otpInputs.forEach((input, i) => {
                    input.value = numbers[i] || '';
                });
                updateOtpField();
                otpInputs[3].focus();
            }
        });
    });

    function updateOtpField() {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        otpField.value = otp;
        
        // Enable/disable verify button
        verifyBtn.disabled = otp.length !== 4;
    }

    // Form submission
    document.getElementById('otpForm').addEventListener('submit', function(e) {
        const otp = otpField.value;
        if (otp.length !== 4) {
            e.preventDefault();
            alert('Please enter the complete 4-digit OTP.');
        }
    });
});
</script>

<style>
.otp-input-container {
    gap: 10px;
}

.otp-input {
    width: 60px;
    height: 60px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.otp-input:focus {
    border-color: #14a800;
    box-shadow: 0 0 0 3px rgba(20, 168, 0, 0.1);
    outline: none;
}

.otp-input.filled {
    border-color: #14a800;
    background-color: #f8fff9;
}

@media (max-width: 576px) {
    .otp-input {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>

</body>

</html> 